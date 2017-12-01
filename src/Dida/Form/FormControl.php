<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

use \Dida\Html\ActiveElement;

/**
 * Control
 */
abstract class FormControl
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
     * @var \Dida\Html\ActiveElement
     */
    protected $controlZone = null;

    /**
     * @var \Dida\Html\ActiveElement
     */
    protected $captionZone = null;

    /**
     * @var \Dida\Html\ActiveElement
     */
    protected $inputZone = null;

    /**
     * @var \Dida\Html\ActiveElement
     */
    protected $helpZone = null;

    /**
     * @var \Dida\Html\ActiveElement
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

        $this->controlZone = new ActiveElement();
        $this->captionZone = $this->controlZone->addChild();
        $this->inputZone = $this->controlZone->addChild();
        $this->helpZone = $this->controlZone->addChild();
        $this->messageZone = $this->controlZone->addChild();

        return $this;
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
     * @var \Dida\Html\ActiveElement
     */
    public function refControlZone()
    {
        return $this->controlZone;
    }


    /**
     * @var \Dida\Html\ActiveElement
     */
    public function refCaptionZone()
    {
        $this->newCaptionZone();
        return $this->captionZone;
    }


    /**
     * @var \Dida\Html\ActiveElement
     */
    public function refInputZone()
    {
        $this->newInputZone();
        return $this->inputZone;
    }


    /**
     * @var \Dida\Html\ActiveElement
     */
    public function refHelpZone()
    {
        return $this->helpZone;
    }


    /**
     * @var \Dida\Html\ActiveElement
     */
    public function refMessageZone()
    {
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


    public function setCaption($caption, $type = self::TEXT)
    {
        if (is_null($caption)) {
            $this->bag['caption'] = $caption;
            return $this;
        }

        switch ($type) {
            case self::TEXT:
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
        $this->newCaptionZone();
        $this->newInputZone();

        // control
        $control = $this->refControlZone();
        return $control->build();
    }
}
