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
 * Hidden
 */
class Hidden extends FormControl
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
        $output[] = '<input type="hidden"';
        foreach ($this->properties as $name => $value) {
            if (!is_null($value)) {
                // 转义
                $name = htmlspecialchars($name);
                $value = htmlspecialchars($value);
                // 生成
                $output[] = " $name=\"$value\"";
            }
        }
        $output[] = '>';

        // 返回
        return implode('', $output);
    }
}
