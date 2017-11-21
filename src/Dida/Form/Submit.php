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
 * Submit
 */
class Submit extends Control
{
    /**
     * Version
     */
    const VERSION = '20171120';


    /**
     * 提交前的共性处理
     */
    use beforeBuildTrait;


    protected function newCaptionZone()
    {
        // do nothing
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('button', 'type="submit"');
    }


    public function build()
    {
        // build前的处理
        $this->beforeBuildButton();

        // 开始build
        return parent::build();
    }
}
