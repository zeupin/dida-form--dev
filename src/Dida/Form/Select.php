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
     * Version
     */
    const VERSION = '20171119';

    /**
     * @var \Dida\Form\OptionSet
     */
    protected $options = null;


    public function __construct($name = null, $id = null)
    {
        parent::__construct($name, $id);

        $this->options = new OptionSet;
    }


    public function addOption($caption = null, $value = null, $checked = false, $disabled = false)
    {
        $this->options->add(null, $caption, $value, $checked, $disabled);
        return $this;
    }


    public function setCaptions($array)
    {
        $this->options->setCaptions($array);
        return $this;
    }


    public function setValues($array)
    {
        $this->options->setValues($array);
        return $this;
    }


    public function setCheckeds($array)
    {
        $this->options->setCheckeds($array);
        return $this;
    }


    public function setDsiableds($array)
    {
        $this->options->setDsiableds($array);
        return $this;
    }


    public function values($values)
    {
        $this->options->check($values);
        return $this;
    }


    public function value($value)
    {
        if (!is_null($value)) {
            $this->options->check([$value]);
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
