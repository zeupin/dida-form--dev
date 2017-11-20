<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form\Control;

/**
 * Control
 */
abstract class Control extends \Dida\Form\HtmlElement
{
    /**
     * @var \Dida\Form\HtmlElement
     */
    protected $captionZone = null;

    /**
     * @var \Dida\Form\HtmlElement
     */
    protected $inputZone = null;

    /**
     * @var \Dida\Form\HtmlElement
     */
    protected $helpZone = null;

    /**
     * @var \Dida\Form\HtmlElement
     */
    protected $messageZone = null;


    public function &refCaptionZone()
    {
        if (!$this->captionZone) {
            $this->captionZone = new \Dida\Form\HtmlElement();
        }
        return $this->captionZone;
    }


    public function &refInputZone()
    {
        if (!$this->inputZone) {
            $this->inputZone = new \Dida\Form\HtmlElement();
        }
        return $this->inputZone;
    }


    public function &refHelpZone()
    {
        if (!$this->helpZone) {
            $this->helpZone = new \Dida\Form\HtmlElement();
        }
        return $this->helpZone;
    }


    public function &refMessageZone()
    {
        if (!$this->messageZone) {
            $this->messageZone = new \Dida\Form\HtmlElement();
        }
        return $this->messageZone;
    }


    /**
     * @return string
     */
    public function build()
    {
        // 准备innerHTML
        $output = [];
        if ($this->captionZone) {
            $output[] = $this->captionZone->build();
        }
        if ($this->inputZone) {
            $output[] = $this->inputZone->build();
        }
        if ($this->helpZone) {
            $output[] = $this->helpZone->build();
        }
        if ($this->messageZone) {
            $output[] = $this->messageZone->build();
        }
        $this->innerHTML = implode('', $output);

        // 注意：是调用parent::build()，不是 $this->build()!!!
        return parent::build();
    }
}
