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
            throw new FormException($type, FormException::CONTROL_TYPE_NOT_FOUND);
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
     * @param \Dida\Form\FormControl $control
     * @param string $id
     */
    public function &addControl($control, $index = null)
    {
        $control->setForm($this);
        if (is_null($index)) {
            $this->controls[] = $control;
        } else {
            $this->controls[$index] = $control;
        }

        return $control;
    }


    public function &addStaticText($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new StaticText(null, $data, $caption, null);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\Text
     */
    public function &addText($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Text($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\Password
     */
    public function &addPassword($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Password($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\Hidden
     */
    public function &addHidden($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Hidden($name, $data, null, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\File
     */
    public function &addFile($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new File($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\TextArea
     */
    public function &addTextArea($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new TextArea($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\Button
     */
    public function &addButton($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Button($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\ResetButton
     */
    public function &addResetButton($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new ResetButton($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\SubmitButton
     */
    public function &addSubmitButton($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new SubmitButton($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\Select
     */
    public function &addSelect($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Select($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\RadioGroup
     */
    public function &addRadioGroup($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new RadioGroup($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }


    /**
     * @return \Dida\Form\CheckboxGroup
     */
    public function &addCheckboxGroup($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new CheckboxGroup($name, $data, $caption, $id);
        $control->setForm($this);
        return $control;
    }
}
