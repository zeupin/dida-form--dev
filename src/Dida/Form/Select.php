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
 * Select
 */
class Select extends FormControl
{
    /**
     * @var \Dida\Form\OptionSet
     */
    protected $options = null;


    public function __construct($name = null, $id = null)
    {
        parent::__construct($name, $id);

        $this->options = new OptionSet;
    }


    public function optionCaptions($captions)
    {
        $this->options->setCaptions($captions);
        return $this;
    }


    public function optionValues($values)
    {
        $this->options->setValues($values);
        return $this;
    }


    public function values($values)
    {
        $this->options->setChecked($values);
        return $this;
    }


    public function value($value)
    {
        if (is_null($value)) {
            $this->options->resetChecked();
        } else {
            $this->options->setChecked([$value]);
        }
        return $this;
    }


    public function build()
    {
        $output = [];

        $name = $this->props->get('name');
        $for = ($name) ? " for=\"{$name}\"" : '';
        $required = ($this->props->get('required')) ? ' *' : '';

        // 对label的处理
        if ($this->label) {
            $output[] = "<label{$for}>{$this->label}{$required}</label>";
        }

        // opentag
        $props = $this->props->build();
        $output[] = "<select{$props}>";

        // 处理 options
        $options = $this->options->getAll();
        foreach ($options as $option) {
            if (is_null($option['caption'])) {
                $caption = '';
            } else {
                $caption = $option['caption'];
                $caption = htmlspecialchars($caption);
            }

            if (is_null($option['value'])) {
                $value = '';
            } else {
                $value = $option['value'];
                $value = htmlspecialchars($value);
                $value = " value=\"{$value}\"";
            }

            if ($option['checked']) {
                $checked = ' selected';
            } else {
                $checked = '';
            }

            $output[] = "<option{$value}{$checked}>{$caption}</option>";
        }

        $output[] = '</select>';

        // 返回
        return implode('', $output);
    }
}
