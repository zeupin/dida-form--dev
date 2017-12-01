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
 * FormControlTrait
 */
trait FormControlTrait
{
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
        /* general */
        'statictext' => 'Dida\\Form\\StaticText', //

        /* input */
        'text'     => 'Dida\\Form\\Text',
        'password' => 'Dida\\Form\\Password',
        'hidden'   => 'Dida\\Form\\Hidden',
        'file'     => 'Dida\\Form\\File', //

        /* textarea */
        'textarea' => 'Dida\\Form\\TextArea', //

        /* button */
        'button'       => 'Dida\\Form\\Button',
        'resetbutton'  => 'Dida\\Form\\ResetButton',
        'submitbutton' => 'Dida\\Form\\SubmitButton', //

        /* group */
        'select'        => 'Dida\\Form\\Select',
        'radiogroup'    => 'Dida\\Form\\RadioGroup',
        'checkboxgroup' => 'Dida\\Form\\CheckboxGroup', //
    ];


    /**
     * 注册一个控件类型。
     *
     * @param string $type   类型名称，供调用控件时使用
     * @param string $class   FQCN格式的类名
     */
    public function registerControlType($type, $class)
    {
        $type = strtolower($type);
        $this->control_types[$type] = $class;

        return $this;
    }


    /**
     * @param \Dida\Form\FormControl $control
     * @return \Dida\Form\FormControl
     */
    public function addControl($control, $formkey = null)
    {
        $control->setForm($this);

        if (is_null($formkey)) {
            $this->controls[] = $control;
        } else {
            $this->controls[$formkey] = $control;
        }

        return $control;
    }


    /**
     * @return \Dida\Form\FormControl
     */
    public function add($type, $name = null, $data = null, $caption = null, $id = null, $formkey = null)
    {
        // 检查类型是否存在
        $type = strtolower($type);
        if (!array_key_exists($type, $this->control_types)) {
            throw new FormException($type, FormException::CONTROL_TYPE_NOT_FOUND);
        }

        // 生成控件
        $control = new $this->control_types[$type]($name, $data, $caption, $id);

        // 把控件的Form属性指向当前Form
        $this->addControl($control, $formkey);

        // 返回control的引用
        return $control;
    }


    public function addStaticText($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new StaticText(null, $data, $caption, null);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\Text
     */
    public function addText($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new Text($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\Password
     */
    public function addPassword($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new Password($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\Hidden
     */
    public function addHidden($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new Hidden($name, $data, null, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\File
     */
    public function addFile($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new File($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\TextArea
     */
    public function addTextArea($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new TextArea($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\Button
     */
    public function addButton($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new Button($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\ResetButton
     */
    public function addResetButton($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new ResetButton($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\SubmitButton
     */
    public function addSubmitButton($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new SubmitButton($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\Select
     */
    public function addSelect($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new Select($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\RadioGroup
     */
    public function addRadioGroup($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new RadioGroup($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }


    /**
     * @return \Dida\Form\CheckboxGroup
     */
    public function addCheckboxGroup($caption = null, $name = null, $data = null, $id = null, $formkey = null)
    {
        $control = new CheckboxGroup($name, $data, $caption, $id);
        $this->addControl($control, $formkey);
        return $control;
    }
}
