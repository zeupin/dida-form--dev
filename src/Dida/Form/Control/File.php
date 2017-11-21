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
 * File
 */
class File extends Control
{
    /**
     * Version
     */
    const VERSION = '20171120';


    /**
     * 提交前的共性处理
     */
    use beforeBuildCommonTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('input', 'type="file"');
    }


    protected function beforeBuild()
    {
        // do nothing
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
