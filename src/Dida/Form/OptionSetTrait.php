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


    public function setOptionCaptions($array)
    {
        $this->options->setOptionCaptions($array);
        return $this;
    }


    public function setOptionValues($array)
    {
        $this->options->setOptionValues($array);
        return $this;
    }


    public function setOptionCheckeds($array)
    {
        $this->options->setOptionCheckeds($array);
        return $this;
    }


    public function setOptionDisableds($array)
    {
        $this->options->setOptionDisableds($array);
        return $this;
    }
}
