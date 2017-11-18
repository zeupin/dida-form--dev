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
 * TextArea
 */
class TextArea extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171118';


    public function setTextValue($text)
    {
        $this->value = nl2br($text);
        return $this;
    }


    public function setParagraphText($text)
    {
        $text = str_replace("\r\n", "\n", $text);
        $lines = explode("\n", $text);
        foreach ($lines as $i => $line) {
            $lines[$i] = "<p>{$line}</p>";
        }
        $this->value = implode('', $lines);
        return $this;
    }


    public function cols($cols)
    {
        $this->setProp('cols', $cols);
        return $this;
    }


    public function rows($rows)
    {
        $this->setProp('rows', $rows);
        return $this;
    }


    public function build()
    {
        $output = [];

        $name = $this->props->get('name');
        $for = ($name) ? " for=\"{$name}\"" : '';

        $required = ($this->props->get('required')) ? ' *' : '';

        // label
        if ($this->label) {
            $output[] = "<label{$for}>{$this->label}{$required}</label>";
        }

        // opentag
        $output[] = '<textarea';
        $output[] = $this->props->build();
        $output[] = '>';

        // content
        $output[] = htmlspecialchars($this->value);

        // closetag
        $output[] = '</textarea>';

        // 返回
        return implode('', $output);
    }
}
