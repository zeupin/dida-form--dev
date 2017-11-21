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
 * AddControlTrait
 */
trait AddControlTrait
{
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


    public function addText($caption = null, $name = null, $data = null, $id = null)
    {
        $control = new Text($caption, $name, $data, $id);
        return $control;
    }
}
