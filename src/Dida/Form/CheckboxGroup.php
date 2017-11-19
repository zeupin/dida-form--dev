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
 * CheckboxGroup
 */
class CheckboxGroup extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171119';


    /**
     * 选项集
     */
    use OptionSetTrait;


    public function build()
    {
        $output = [];

        $name = $this->props->get('name');
        $required = ($this->props->get('required')) ? ' *' : '';

        // 对label的处理
        if ($this->label) {
            $output[] = "<label>{$this->label}{$required}</label>";
        }

        // opentag
        $props = $this->props->build();

        // 处理 options
        $options = $this->options->getAll();
        foreach ($options as $index => $option) {
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
                $checked = ' checked';
            } else {
                $checked = '';
            }

            // 为option设置一个独立的名字
            if (mb_substr($name, -2) === '[]') {
                $option_name = mb_substr($name, 0, -2) . '___' . $index . '[]';
            } else {
                $option_name = $name . '___' . $index;
            }
            $option_name = " name=\"{$option_name}\"";

            $output[] = "<input type=\"checkbox\"{$option_name}{$value}{$checked}>{$caption}</option>";
        }

        // 返回
        return implode('', $output);
    }
}
