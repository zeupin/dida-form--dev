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
class StaticText extends Control
{
    /**
     * Version
     */
    const VERSION = '20171120';


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('div');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('div');
    }


    protected function beforeBuild()
    {
        if (isset($this->bag['caption'])) {
            $caption = $this->bag['caption'];
            $this->refCaptionZone()->setInnerHTML($caption);
        }

        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setInnerHTML(htmlspecialchars($value));
        }
    }


    public function build()
    {
        // build前的处理
        $this->beforeBuild();

        // 开始build
        return parent::build();
    }
}
