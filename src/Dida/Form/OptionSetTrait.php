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
 * OptionSetTrait
 */
trait OptionSetTrait
{
    /**
     * @var \Dida\Form\OptionSet
     */
    protected $options = null;


    public function __construct($name = null, $id = null)
    {
        parent::__construct($name, $id);

        $this->options = new OptionSet;
    }


    public function addOption($caption = null, $value = null, $checked = false, $disabled = false)
    {
        $this->options->add(null, $caption, $value, $checked, $disabled);
        return $this;
    }


    public function setCaptions($array)
    {
        $this->options->setCaptions($array);
        return $this;
    }


    public function setValues($array)
    {
        $this->options->setValues($array);
        return $this;
    }


    public function setCheckeds($array)
    {
        $this->options->setCheckeds($array);
        return $this;
    }


    public function setDsiableds($array)
    {
        $this->options->setDsiableds($array);
        return $this;
    }


    public function check($data)
    {
        if (is_array($data)) {
            $this->options->check($data);
        } elseif (!is_null($data)) {
            $this->options->check([$data]);
        }
        return $this;
    }
}
