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
 * StaticText
 */
class StaticText extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171117';

    public function build()
    {
        $output = [];

        // 对label的处理
        if ($this->caption) {
            $output[] = "<label>{$this->caption}</label>";
        }

        // input:text
        $output[] = $this->valueHtml;

        // 返回
        return implode('', $output);
    }
}
