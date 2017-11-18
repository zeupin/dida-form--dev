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


    public function value($value)
    {
        parent::value($value);

        $this->setProp('value', $value);
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

        // input:text
        $output[] = '<input type="text"';
        $output[] = $this->props->build();
        $output[] = '>';

        // 返回
        return implode('', $output);
    }
}
