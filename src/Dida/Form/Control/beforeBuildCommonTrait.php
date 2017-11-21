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
 * beforeBuildCommonTrait
 */
trait beforeBuildCommonTrait
{


    protected function beforeBuildCommon()
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
}
