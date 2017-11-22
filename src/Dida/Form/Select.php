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
 * Select
 */
class Select extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171120';


    /**
     * 选项集
     */
    use \Dida\Form\OptionSetTrait;


/**
     * 提交前的共性处理
     */
    use BeforeBuildTrait;


    protected function newCaptionZone()
    {
        $this->captionZone->setTag('label');
    }


    protected function newInputZone()
    {
        $this->inputZone->setTag('select');
    }


    protected function beforeBuild()
    {
        // 处理 options
        $options = $this->options->getAll();

        // 逐一处理
        foreach ($options as $option) {
            $opt = $this->refInputZone()->addChild('option');
            $opt->setInnerHTML($option['caption'])
                ->setProp('value', $option['value'])
                ->setProp('selected', $option['checked']);
        }
    }


    public function build()
    {
        // build前的处理
        $this->beforeBuildText();
        $this->beforeBuild();

        // 开始build
        return parent::build();
    }
}
