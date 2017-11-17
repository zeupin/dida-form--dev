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
     * 属性集
     *
     * @var \Dida\Form\PropertySet
     */
    protected $props = null;


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
        $this->props = new PropertySet([
            'id'   => $id,
            'name' => $name,
        ]);
    }


    /**
     * @param \Dida\Form\Form $form
     */
    public function setForm(&$form)
    {
        $this->form = $form;

        return $this;
    }


    public function setProp($name, $value)
    {
        $this->props->set($name, $value);
        return $this;
    }


    public function getProp($name)
    {
        return $this->props->get($name);
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
        if ($bool) {
            $this->props->set('required', true);
        } else {
            $this->props->remove('required');
        }
        return $this;
    }


    /**
     * 是否禁用。
     *
     * @param boolean $bool
     */
    public function disabled($bool = true)
    {
        if ($bool) {
            $this->props->set('disabled', true);
        } else {
            $this->props->remove('disabled');
        }
        return $this;
    }


    /**
     * 是否只读。
     *
     * @param boolean $bool
     */
    public function readonly($bool = true)
    {
        if ($bool) {
            $this->props->set('readonly', true);
        } else {
            $this->props->remove('readonly');
        }
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
