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
 * beforeBuildTrait
 */
trait beforeBuildTrait
{


    /**
     * 针对独立的文本输入元素，比如 Text，Password，TextArea
     */
    protected function beforeBuildText()
    {
        if (isset($this->bag['caption'])) {
            $caption = $this->bag['caption'];
            $this->refCaptionZone()->setInnerHTML($caption);
        }

        if (isset($this->bag['required'])) {
            $this->refCaptionZone()->addChild()->setInnerHTML(' *');
        }

        if (isset($this->bag['name'])) {
            $name = $this->bag['name'];
            $this->refInputZone()->setName($name);
        }

        if (isset($this->bag['id'])) {
            $id = $this->bag['id'];
            $this->refInputZone()->setID($id);
            $this->refCaptionZone()->setProp('for', $id);
        }
    }


    /**
     * 针对按钮类的输入元素
     */
    protected function beforeBuildButton()
    {
        if (isset($this->bag['caption'])) {
            $caption = $this->bag['caption'];
            $this->refInputZone()->setInnerHTML($caption);
        }

        if (isset($this->bag['name'])) {
            $name = $this->bag['name'];
            $this->refInputZone()->setName($name);
        }

        if (isset($this->bag['id'])) {
            $id = $this->bag['id'];
            $this->refInputZone()->setID($id);
        }

        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setProp('value', htmlspecialchars($value));
        }
    }
}
