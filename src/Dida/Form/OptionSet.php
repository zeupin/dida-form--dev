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
    const VERSION = '20171119';

    /**
     * options数组。
     *
     * 是一个二维表格数组，[ index => option ]。
     * 通过setValues,setCaptions，必须严格匹配相应的index。
     *
     * @var array
     */
    protected $options = [];

    /**
     * 新option的模板。
     *
     * @var array
     */
    protected $newoption = [
        'caption'  => null,
        'value'    => null,
        'checked'  => false,
        'disabled' => false,
    ];


    /**
     * 新增一个option。
     *
     * @param int|string $index
     * @param string $caption
     * @param mixed $value
     * @param boolean $checked
     * @param boolean $disabled
     *
     * @return $this
     */
    public function add($index, $caption = null, $value = null, $checked = false, $disabled = false)
    {
        $this->options[$indx] = [
            'caption'  => $caption,
            'value'    => $value,
            'checked'  => $checked,
            'disabled' => $disabled,
        ];

        return $this;
    }


    /**
     * 获取指定index的option的指定键值。
     *
     * @param int|string $index
     * @param string $key
     *
     * @return mixed
     */
    public function get($index, $key)
    {
        // option不存在，返回null
        if (!array_key_exists($index, $this->options)) {
            return null;
        }

        // option的键名不存在
        if (array_key_exists($key, $this->options[$index])) {
            return null;
        }

        // 返回option的键值
        return $this->options[$index][$key];
    }


    /**
     * 设置指定index的option的指定键值
     *
     * @param int|string $index
     * @param string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function set($index, $key, $value)
    {
        // option不存在，则创建
        if (!array_key_exists($index, $this->options)) {
            $this->options[$index] = $this->newoption;
        }

        // 设置值
        $this->options[$index][$key] = $value;

        // 完成
        return $this;
    }


    /**
     * 返回当前的options数组
     */
    public function getAll()
    {
        return $this->options;
    }


    /**
     * 批量设置options的caption。
     *
     * @param array $captions   [ index => caption ]
     */
    public function setCaptions(array $array_by_index)
    {
        foreach ($array_by_index as $index => $value) {
            $this->set($index, 'caption', $value);
        }

        return $this;
    }


    /**
     * 批量设置options的value。
     *
     * @param array $array_by_index   [ index => value ]
     */
    public function setValues(array $array_by_index)
    {
        foreach ($array_by_index as $index => $value) {
            $this->set($index, 'value', $value);
        }

        return $this;
    }


    /**
     * 批量设置options的默认checked。
     *
     * @param array $array_by_index   [ index => checked ]
     */
    public function setChecked(array $array_by_index)
    {
        foreach ($array_by_index as $index => $value) {
            $this->set($index, 'checked', $value);
        }

        return $this;
    }


    /**
     * 批量设置options的默认disabled。
     *
     * @param array $array_by_index   [ index => disabled ]
     */
    public function setDsiabled(array $array_by_index)
    {
        foreach ($array_by_index as $index => $value) {
            $this->set($index, 'disabled', $value);
        }

        return $this;
    }


    /**
     * @param array $checked   一维数组，[ value ]
     */
    public function check(array $values)
    {
        foreach ($this->options as $index => $option) {
            // 如果当前项是disabled，跳过
            if ($this->get($index, 'disabled')) {
                continue;
            }

            // 有value比较value，没有value比较caption，都没有则设置为false
            if (isset($option['value'])) {
                $this->options[$index]['checked'] = (in_array($option['value'], $values));
                continue;
            } elseif (isset($option['caption'])) {
                $this->options[$index]['checked'] = (in_array($option['caption'], $values));
                continue;
            } else {
                $this->options[$index]['checked'] = false;
                continue;
            }
        }

        return $this;
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
