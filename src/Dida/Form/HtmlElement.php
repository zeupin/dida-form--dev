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
 * HtmlElement
 */
class HtmlElement
{
    /**
     * Version
     */
    const VERSION = '20171120';

    /**
     * 布尔属性的列表
     *
     * @var array
     */
    protected $bool_prop_list = [
        'disabled'       => null,
        'readonly'       => null,
        'required'       => null,
        'hidden'         => null,
        'checked'        => null,
        'selected'       => null,
        'autofocus'      => null,
        'multiple'       => null,
        'formnovalidate' => null,
    ];

    /**
     * @var string
     */
    protected $id = null;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $class = null;

    /**
     * @var array
     */
    protected $style = [];

    /**
     * @var array
     */
    protected $props = [];

    /**
     * @var string
     */
    protected $innerHTML = '';


    public function setID($id)
    {
        $this->id = trim($id);
        return $this;
    }


    public function getID()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = trim($name);
        return $this;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setClass($class)
    {
        $this->class = trim($class);
        return $this;
    }


    public function getClass()
    {
        return $this->class;
    }


    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }


    public function getStyle()
    {
        return $this->style;
    }


    public function setProp($name, $value)
    {
        // 属性名是否合法
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        // 属性值是否合法
        if (!is_scalar($value) && !is_null($value)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_VALUE);
        }

        // 属性名转小写
        $name = strtolower($name);

        // id
        if ($name === 'id') {
            $this->setID($value);
            return $this;
        }

        // name
        if ($name === 'name') {
            $this->setName($value);
            return $this;
        }

        // class
        if ($name === 'class') {
            $this->setClass($value);
            return $this;
        }

        // style
        if ($name === 'style') {
            $this->setStyle($value);
            return $this;
        }

        // 如果是布尔型的属性
        if (array_key_exists($name, $this->bool_prop_list)) {
            if ($value && ($value !== 'false')) {
                $this->props[$name] = $name;
            } else {
                unset($this->props[$name]);
            }
            return $this;
        }

        // 一般的属性，则设置属性值
        $this->props[$name] = strval($value);

        // 返回
        return $this;
    }


    public function getProp($name)
    {
        // 属性名是否合法
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        // 属性名转小写
        $name = strtolower($name);

        // 如果是常规属性
        switch ($name) {
            case 'id':
                return $this->id;
            case 'name':
                return $this->name;
            case 'class':
                return $this->class;
            case 'style':
                return $this->style;
        }

        // 如果是布尔型的属性
        if (array_key_exists($name, $this->bool_prop_list)) {
            return array_key_exists($name, $this->props);
        }

        // 如果属性存在，返回属性值，不存在返回null
        if (array_key_exists($name, $this->props)) {
            return $this->props[$name];
        } else {
            return null;
        }
    }


    public function removeProp($name)
    {
        $name = strtolower($name);
        switch ($name) {
            case 'id':
                $this->id = null;
                break;
            case 'name':
                $this->name = null;
                break;
            case 'class':
                $this->class = [];
                break;
            case 'style':
                $this->style = [];
                break;
            default:
                unset($this->props[$name]);
        }

        return $this;
    }


    /**
     * 构建元素的属性表达式
     */
    public function buildProps()
    {
        $output = [];

        if ($this->id) {
            $output[] = ' id="' . $this->id . '"';
        }
        if ($this->name) {
            $output[] = ' name="' . $this->name . '"';
        }
        if ($this->class) {
            $output[] = ' class="' . $this->class . '"';
        }
        foreach ($this->props as $name => $value) {
            if (array_key_exists($name, $this->bool_prop_list)) {
                $output[] = " $name";
            } else {
                $output[] = " $name=\"$value\"";
            }
        }
        if ($this->style) {
            $output[] = ' style="' . implode('', $this->style) . '"';
        }

        return implode('', $output);
    }
}
