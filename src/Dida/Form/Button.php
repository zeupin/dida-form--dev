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
 * Button
 */
class Button extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171118';

    /**
     * @var string
     */
    protected $value = null;


    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }


    public function label($label)
    {
        $this->label = htmlspecialchars($label);
        return $this;
    }


    public function labelHtml($lable)
    {
        $this->label = $lable;
        return $this;
    }


    public function build()
    {
        $output = [];

        // opentag
        $output[] = '<button type="button"';
        $output[] = $this->props->build();
        if (isset($this->value)) {
            $value = htmlspecialchars($this->value);
            $output[] = ' value="' . $value . '"';
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