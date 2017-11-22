<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

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
    protected $formElement = null;


    /**
     * 表单控件
     */
    use FormControlTrait;


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
                $this->addHidden(null, self::REQUEST_METHOD, $method, null, self::REQUEST_METHOD);
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
