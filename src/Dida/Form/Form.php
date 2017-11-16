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
     * 属性组
     */
    protected $properties = [];

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


    public function __construct($action = null, $method = 'get', $name = null, $id = null)
    {
        if (!is_null($action) && is_string($action)) {
            $this->properties['action'] = $action;
        }

        $this->setMethod($method);

        $this->action = $action;
        $this->method = $method;
        $this->name = $name;
        $this->id = $id;
    }


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
                $this->addHidden(self::HTTP_METHOD, $method);
                break;

            default:
                throw new FormException($method, FormException::INVALID_METHOD);
        }

        return $this;
    }


    public function getMethod()
    {
        return $this->method;
    }


    public function addHidden($name = null, $value = null)
    {
        if ($name === null) {
            $this->controls[] = new Hidden($name, $value);
        } else {
            $this->controls[$name] = new Hidden($name, $value);
        }
    }
}
