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
 * Text
 */
class Text extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171117';


    public function setValue($value)
    {
        $this->properties['value'] = $value;
        return $this;
    }


    public function build()
    {
        $output = [];

        $for = ($this->properties['name']) ? " for=\"{$this->properties['name']}\"" : '';

        $required = ($this->required) ? ' *' : '';

        // 对label的处理
        if ($this->label) {
            $output[] = "<label{$for}>{$this->label}{$required}</label>";
        }

        $output[] = '<input type="text"';
        foreach ($this->properties as $prop => $value) {
            if (!is_null($value)) {
                // 转义
                $prop = htmlspecialchars($prop);
                $value = htmlspecialchars($value);
                // 生成
                $output[] = " $prop=\"$value\"";
            }
        }
        $output[] = '>';

        // 返回
        return implode('', $output);
    }
}
