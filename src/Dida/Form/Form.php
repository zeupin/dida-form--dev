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
     * REQUEST_METHOD的表单域的名称
     */
    const REQUEST_METHOD = 'DIDA_REQUEST_METHOD';

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
     * 控件类型对应的类名
     *
     * @var array
     */
    protected $control_types = [
        /* input */
        'text'       => 'Dida\\Form\\Text',
        'password'   => 'Dida\\Form\\Password',
        'hidden'     => 'Dida\\Form\\Hidden',
        'file'       => 'Dida\\Form\\File',
        'statictext' => 'Dida\\Form\\StaticText', //

        /* button */
        'button' => 'Dida\\Form\\Button',
        'reset'  => 'Dida\\Form\\Reset',
        'submit' => 'Dida\\Form\\Submit', //

        /* textarea */
        'textarea' => 'Dida\\Form\\TextArea', //

        /* group */
        'select'        => 'Dida\\Form\\Select',
        'radiogroup'    => 'Dida\\Form\\RadioGroup',
        'checkboxgroup' => 'Dida\\Form\\CheckboxGroup', //
    ];
    protected $formElement = null;


    /**
     * @param string $action
     * @param string $method
     * @param string $name
     * @param string $id
     */
    public function __construct($action = null, $method = 'get', $name = null, $id = null)
    {
        $this->formElement = new HtmlElement('form');

        // method要特别处理一下
        $this->setMethod($method);
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
                $this->formElement->setProp('method', $method);
                unset($this->controls[self::REQUEST_METHOD]);
                break;

            case 'put':
            case 'patch':
            case 'delete':
            case 'head':
            case 'options':
                $this->method = $method;
                // method属性设置为post
                $this->formElement->setProp('method', 'post');
                // 实际的method存到一个input:hidden里面
                $this->add('hidden', self::REQUEST_METHOD, $method, null, null, self::REQUEST_METHOD);
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


    public function &refFormElement()
    {
        return $this->formElement;
    }


    /**
     * 注册一个控件类型。
     *
     * @param string $type
     * @param string $class
     */
    public function registerType($type, $class)
    {
        $type = strtolower($type);
        $this->control_types[$type] = $class;

        return $this;
    }


    /**
     * 向Form中新增一个控件。
     *
     * @param string $type
     * @param string $name
     * @param mixed $data
     * @param string $index
     *
     * @return \Dida\Form\FormControl  返回生成的表单控件，供进一步设置
     *
     * @throws FormException
     */
    public function &add($type, $name = null, $data = null, $caption = null, $id = null, $index = null)
    {
        // 检查类型是否存在
        $type = strtolower($type);
        if (!array_key_exists($type, $this->control_types)) {
            throw new FormException($type, FormException::TYPE_NOT_FOUND);
        }

        // 生成控件
        $control = new $this->control_types[$type]($name, $data, $caption, $id);

        // 把控件的Form属性指向当前Form
        $control->setForm($this);

        // 根据$index，决定把control加到当前Form的最后，还是覆盖掉同一index的原有控件。
        if (is_string($index)) {
            $this->controls[$index] = &$control;
        } else {
            $this->controls[] = &$control;
        }

        // 返回control的引用
        return $control;
    }


    /**
     * 构建表单的HTML。
     *
     * @return string
     */
    public function build()
    {
        // 构建表单控件
        $output = [];
        foreach ($this->controls as $control) {
            $output[] = $control->build();
        }
        $html = implode('', $output);
        $this->formElement->setInnerHTML($html);

        // 输出
        return $this->formElement->build();
    }
}
