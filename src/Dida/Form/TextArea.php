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
 * TextArea
 */
class TextArea extends FormControl
{
    /**
     * Version
     */
    const VERSION = '20171120';


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
        $this->inputZone->setTag('textarea');
    }


    /**
     * 设置rows和cols。
     *
     * @param int $rows
     * @param int $cols
     */
    public function setRowsAndCols($rows = null, $cols = null)
    {
        $this->bag['rows'] = $rows;
        $this->bag['cols'] = $cols;
        return $this;
    }


    protected function beforeBuild()
    {
        $rows = (isset($this->bag['rows'])) ? $this->bag['rows'] : 6;
        $cols = (isset($this->bag['cols'])) ? $this->bag['cols'] : 40;
        $this->refInputZone()->setProp('cols', $cols)->setProp('rows', $rows);

        if (isset($this->data)) {
            $value = $this->data;
            $this->refInputZone()->setInnerHTML(htmlspecialchars($value));
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
