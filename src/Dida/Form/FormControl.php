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
    const VERSION = '20171116';

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
