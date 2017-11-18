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
 * Reset
 */
class Reset extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171118';

    /**
     * @var string
     */
    protected $value = null;


    public function build()
    {
        $output = [];

        // opentag
        $output[] = '<button type="reset"';
        $output[] = $this->props->build();
        if (isset($this->valueHtml)) {
            $output[] = ' value="' . $this->valueHtml . '"';
        }
        $output[] = '>';

        // label
        if (isset($this->label)) {
            $output[] = $this->label;
        }

        // closetag
        $output[] = "</button>";

        // return
        return implode('', $output);
    }
}
