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
 * CheckboxGroup
 */
class CheckboxGroup extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171120';


    /**
     * 选项集
     */
    use \Dida\Form\OptionSetTrait;


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

        if (isset($this->bag['required'])) {
            $this->refCaptionZone()->addChild()->setInnerHTML(' *');
        }

        // 设置 data
        $this->check($this->data);

        // 处理 options
        $options = $this->options->getAll();

        $name = $this->bag['name'];
        foreach ($options as $index => $option) {
            $this->refInputZone()
                ->addChild('label')
                ->addChild('input')->setProp('type', 'checkbox')
                ->setName("{$name}___{$index}")
                ->setProp('value', $option['value'])
                ->setProp('checked', $option['checked'])
                ->insertAfter()->setInnerHTML($option['caption'])
            ;
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
