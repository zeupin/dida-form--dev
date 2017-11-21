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
 * Control
 */
abstract class Control
{
    /**
     * Version
     */
    const VERSION = '20171121';

    /**
     * 格式常量
     */
    const TEXT = 'text';
    const HTML = 'html';

    /**
     * 控件的数据。
     *
     * @var array
     */
    protected $data = null;

    /**
     * 存放杂项资料。
     *
     * @var array
     */
    protected $bag = [];

    /**
     * 指向Form。
     *
     * @var \Dida\Form\Form
     */
    protected $form = null;

    /**
     * @var \Dida\Form\HtmlElement
     */
    protected $controlZone = null;

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


    abstract protected function newCaptionZone();


    abstract protected function newInputZone();


    public function __construct($name = null, $data = null, $caption = null, $id = null)
    {
        if (!is_null($name)) {
            $this->setName($name);
        }
        if (!is_null($data)) {
            $this->setData($data);
        }
        if (!is_null($caption)) {
            $this->setCaption($caption);
        }
        if (!is_null($id)) {
            $this->setID($id);
        }
    }


    /**
     * @param \Dida\Form\Form $form
     */
    public function setForm(&$form)
    {
        $this->form = $form;

        return $this;
    }


    /**
     * @var \Dida\Form\HtmlElement
     */
    public function &refControlZone()
    {
        if (!$this->controlZone) {
            $this->controlZone = new \Dida\Form\HtmlElement();
        }
        return $this->controlZone;
    }


    /**
     * @var \Dida\Form\HtmlElement
     */
    public function &refCaptionZone()
    {
        if (!$this->captionZone) {
            $this->captionZone = new \Dida\Form\HtmlElement();
            $this->newCaptionZone();
        }
        return $this->captionZone;
    }


    /**
     * @var \Dida\Form\HtmlElement
     */
    public function &refInputZone()
    {
        if (!$this->inputZone) {
            $this->inputZone = new \Dida\Form\HtmlElement();
            $this->newInputZone();
        }
        return $this->inputZone;
    }


    /**
     * @var \Dida\Form\HtmlElement
     */
    public function &refHelpZone()
    {
        if (!$this->helpZone) {
            $this->helpZone = new \Dida\Form\HtmlElement();
        }
        return $this->helpZone;
    }


    /**
     * @var \Dida\Form\HtmlElement
     */
    public function &refMessageZone()
    {
        if (!$this->messageZone) {
            $this->messageZone = new \Dida\Form\HtmlElement();
        }
        return $this->messageZone;
    }


    public function setName($name)
    {
        $this->bag['name'] = $name;
        return $this;
    }


    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }


    public function setCaption($caption, $type = Control::TEXT)
    {
        if (is_null($caption)) {
            $this->bag['caption'] = $caption;
            return $this;
        }

        switch ($type) {
            case Control::TEXT:
                $caption = htmlspecialchars($caption);
                $caption = nl2br($caption);
                break;
        }
        $this->bag['caption'] = $caption;
        return $this;
    }


    public function setID($id = null)
    {
        $this->bag['id'] = $id;
        return $this;
    }


    public function required($bool = true)
    {
        if ($bool) {
            $this->bag['required'] = true;
        } else {
            unset($this->bag['required']);
        }

        return $this;
    }


    /**
     * 控件设置完成，返回Form对象
     */
    public function done()
    {
        return $this->form;
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

        // control
        $control = $this->refControlZone();
        $control->setInnerHTML(implode('', $output));
        return $control->build();
    }
}
