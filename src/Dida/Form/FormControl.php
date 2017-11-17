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
 * FormControl
 */
abstract class FormControl
{
    /**
     * Version
     */
    const VERSION = '20171117';

    /**
     * 指向Form。
     *
     * @var \Dida\Form\Form
     */
    protected $form = null;

    /**
     * @var string
     */
    protected $label = null;

    /**
     * 是否是必填项。
     *
     * @var boolean
     */
    protected $required = false;


    /**
     * 属性的设置和读取
     */
    use PropertyTrait;


    /**
     * build当前control
     */
    abstract public function build();


    /**
     * 设置值
     */
    abstract public function setValue($value);


    /**
     * 控件初始化
     *
     * @param string $name
     * @param string $id
     */
    public function __construct($name = null, $id = null)
    {
        $this->properties['id'] = $id;
        $this->properties['name'] = $name;
    }


    /**
     * 指向Form。
     *
     * @param \Dida\Form\Form $form
     */
    public function setForm(&$form)
    {
        $this->form = $form;

        return $this;
    }


    /**
     * 设置label。
     *
     * @param string $label
     */
    public function label($label)
    {
        $this->label = $label;
        return $this;
    }


    /**
     * 是否是必填项。
     *
     * @param boolean $bool
     */
    public function required($bool = true)
    {
        $this->required = boolval($bool);
        return $this;
    }


    /**
     * 控件设置完成，返回Form对象
     */
    public function done()
    {
        return $this->form;
    }
}
