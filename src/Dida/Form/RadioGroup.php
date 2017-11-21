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
 * RadioGroup
 */
class RadioGroup extends FormControl
{
    /**
     * @var string
     */
    protected $defaultValue = null;

    /**
     * @var array
     */
    protected $options = [];


    /**
     *  设置选项。
     * 。
     * @param array $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }


    public function defaultValue($value)
    {
        $this->defaultValue = $value;
        return $this;
    }


    public function build()
    {
        $output = [];

        $name = $this->props->get('name');
        $for = ($name) ? " for=\"{$name}\"" : '';
        $required = ($this->props->get('required')) ? ' *' : '';

        // 对label的处理
        if ($this->caption) {
            $output[] = "<label{$for}>{$this->caption}{$required}</label>";
        }

        // 整合默认值
        if (is_null($this->value)) {
            $value = $this->defaultValue;
        } else {
            $value = $this->value;
        }

        // 逐一处理
        $props = $this->props->build(['id']);
        foreach ($this->options as $caption => $option) {
            if (is_int($caption)) {
                $caption = $option;
            }
            $optionstr = ' value="' . htmlspecialchars($option) . '"';
            $checked = ("{$value}" == "$option") ? ' checked' : '';
            $caption = htmlspecialchars($caption);
            $output[] = "<input type=\"radio\"{$props}{$optionstr}{$checked}>{$caption}";
        }

        // 返回
        return implode('', $output);
    }
}
