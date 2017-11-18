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
 * OptionSet
 */
class OptionSet
{
    /**
     * Version
     */
    const VERSION = '20171117';

    /**
     * options是一个二维表格数组
     * [
     *     index => [
     *                  'value'   => ,
     *                  'caption' => ,
     *                  'checked  => ,
     *              ]
     * ]
     * 通过setValues,setCaptions，必须严格匹配相应的index。
     *
     * @var array
     */
    protected $options = [];

    /**
     * 行初始化。
     *
     * @var type
     */
    protected $newoption = [
        'caption' => null,
        'value'   => null,
        'checked' => false,
    ];


    /**
     * 返回当前的options
     */
    public function getAll()
    {
        return $this->options;
    }


    /**
     * @param array $values   一维数组，[ index => value ]
     */
    public function setValues(array $values)
    {
        foreach ($values as $index => $value) {
            if (!isset($this->options[$index])) {
                $this->options[$index] = $this->newoption;
            }
            $this->options[$index]['value'] = $value;
        }

        return $this;
    }


    /**
     * @param array $captions   一维数组，[ index => caption ]
     */
    public function setCaptions(array $captions)
    {
        foreach ($captions as $index => $caption) {
            if (!isset($this->options[$index])) {
                $this->options[$index] = $this->newoption;
            }
            $this->options[$index]['caption'] = $caption;
        }

        return $this;
    }


    /**
     * @param array $checked   一维数组，[ value ]
     */
    public function setChecked(array $values)
    {
        foreach ($this->options as $index => $item) {
            if (isset($item['value'])) {
                $this->options[$index]['checked'] = (in_array($item['value'], $values));
                continue;
            } elseif (isset($item['caption'])) {
                $this->options[$index]['checked'] = (in_array($item['caption'], $values));
                continue;
            } else {
                $this->options[$index]['checked'] = false;
                continue;
            }
        }
    }


    /**
     * 重置checked。
     */
    public function resetChecked()
    {
        foreach ($this->options as $index => $item) {
            $this->options[$index]['checked'] = false;
        }
    }
}
