<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

use \Dida\Form\Exceptions\FormException;

/**
 * Form
 */
class Form
{
    /**
     * Version
     */
    const VERSION = '20171116';

    /**
     * HTTP_METHOD的表单域的名称
     */
    const HTTP_METHOD = 'DIDA_HTTP_METHOD';

    /**
     * Form的属性值：get/post/put/patch/delete/head/options
     *
     * @var string
     */
    protected $method = null;

    /**
     * 所有表单控件。
     *
     * @var array
     */
    protected $controls = [];


    /**
     * 对属性的操作
     */
    use PropertyTrait;


    /**
     * @param string $action
     * @param string $method
     * @param string $name
     * @param string $id
     */
    public function __construct($action = null, $method = 'get', $name = null, $id = null)
    {
        // 常规属性
        $this->properties = [
            'id'     => $id,
            'name'   => $name,
            'method' => 'get',
            'action' => $action,
        ];

        // method要特别处理一下
        $this->setMethod($method);
    }


    /**
     * 构建表单的HTML。
     *
     * @return string
     */
    public function build()
    {
        $output = [];

        // 构建opentag
        $output[] = '<form';

        // 构建属性
        foreach ($this->properties as $name => $value) {
            if ($value !== null) {
                $name = htmlspecialchars($name);

                if ($this->isBoolProp($name)) {
                    $output[] = " $name";
                } else {
                    $value = htmlspecialchars($value);
                    $output[] = " $name=\"$value\"";
                }
            }
        }
        $output[] = '>';

        // 构建表单控件
        foreach ($this->controls as $control) {
            $output[] = $control->build();
        }

        // 构建closetag
        $output[] = '</form>';

        // 输出
        return implode('', $output);
    }


    /**
     * 设置Form的httpmethod
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $method = strtolower($method);
        switch ($method) {
            case 'get':
            case 'post':
                $this->method = $method;
                $this->properties['method'] = $method;
                unset($this->controls[self::HTTP_METHOD]);
                break;

            case 'put':
            case 'patch':
            case 'delete':
            case 'head':
            case 'options':
                $this->method = $method;
                // method属性设置为post
                $this->properties['method'] = 'post';
                // 实际的method存到一个input:hidden里面
                $this->addHidden(self::HTTP_METHOD, $method, true);
                break;

            default:
                throw new FormException($method, FormException::INVALID_METHOD);
        }

        return $this;
    }


    /**
     * 获取表单的httpmethod。
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * 新增一个hidden型的表单控件。
     *
     * @param string $name
     * @param mixed $value
     * @param boolean $index   在控件数组中的索引
     *
     * @return \Dida\Form\FormControl
     */
    public function &addHidden($name, $value = null, $index = null)
    {
        $control = new Hidden($name, $value);

        if (is_string($index)) {
            $this->controls[$index] = $control;
            return $this->controls[$index];
        } else {
            $this->controls[] = $control;
            return end($this->controls);
        }
    }
}
