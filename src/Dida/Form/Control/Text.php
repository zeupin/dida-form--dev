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
 * Text
 */
class Text extends Control
{
    /**
     * Version
     */
    const VERSION = '20171120';


    public function __construct($caption = null, $name = null)
    {
        $this->setCaption($caption);
        $this->setName($name);
    }


    public function setCaption($caption)
    {
        if ($caption === null) {
            $this->captionZone = null;
            return $this;
        }

        $this->prepareCaptionZone()->setTag('label')
            ->setInnerHTML(htmlspecialchars($caption));
        return $this;
    }


    public function setName($name)
    {
        $this->prepareInputZone()->setTag('input', true, 'type="text"')
            ->setName($name);
        $this->prepareCaptionZone()->setTag('label')
            ->setProp('for', $name);

        return $this;
    }


    public function setValue($value)
    {
        $this->prepareInputZone()->setTag('input', true, 'type="text"')
            ->setProp('value', htmlspecialchars($value));
        return $this;
    }
}
