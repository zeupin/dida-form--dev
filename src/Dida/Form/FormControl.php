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
     * 控件设置完成，返回Form对象
     */
    public function done()
    {
        return $this->form;
    }
}
