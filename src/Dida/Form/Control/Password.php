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
 * Password
 */
class Password extends Control
{
    /**
     * Version
     */
    const VERSION = '20171120';


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('input', 'type="password"');
    }


    protected function beforeBuild()
    {
        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setProp('value', htmlspecialchars($value));
        }
    }


    public function build()
    {
        // build前的处理
        $this->beforeBuildCommon();
        $this->beforeBuild();

        // 开始build
        return parent::build();
    }
}
