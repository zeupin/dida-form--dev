<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form;

use \Dida\Form\Exceptions\FormException;

/**
 * PropertySet
 */
class PropertySet
{
    /**
     * 属性集。
     *
     * @var array
     */
    protected $props = [
        'id'    => null,
        'name'  => null,
        'class' => [],
        'style' => [],
    ];

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


    public function __construct(array $props)
    {
        foreach ($props as $name => $value) {
            $this->set($name, $value);
        }
    }


    /**
     * 设置一个属性值。
     *
     * @param string $name
     * @param mixed $value
     *
     * @throws FormException
     */
    public function set($name, $value)
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

        // class
        if ($name === 'class') {
            $this->addClass($value);
            return $this;
        }

        // style
        if ($name === 'style') {
            $this->addStyle($value);
            return $this;
        }

        // 如果是布尔型的属性
        if (array_key_exists($name, $this->bool_prop_list)) {
            if ($value && ($value !== 'false')) {
                $this->props[$name] = true;
            } else {
                unset($this->props[$name]);
            }
            return $this;
        }

        // 一般的属性，则设置值
        $this->props[$name] = $value;
        return $this;
    }


    /**
     * 删除一个属性
     *
     * @param string $name
     */
    public function remove($name)
    {
        $name = strtolower($name);
        switch ($name) {
            case 'id':
            case 'name':
                $this->props[$name] = null;
                break;
            case 'class':
            case 'style':
                $this->props[$name] = [];
                break;
            default:
                unset($this->props[$name]);
        }

        return $this;
    }


    /**
     * 获取一个属性值。
     *
     * @param string $name
     *
     * @return mixed|null
     */
    public function get($name)
    {
        // 属性名是否合法
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        // 属性名转小写
        $name = strtolower($name);

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


    /**
     * 新增class。
     *
     * @param string $class
     */
    public function addClass($class)
    {
        $class = trim($class);
        $classes = explode(' ', $class);
        foreach ($classes as $class) {
            $this->props['class'][$class] = $class;
        }

        return $this;
    }


    /**
     * 删除class。
     *
     * @param string $class
     */
    public function removeClass($class)
    {
        $class = trim($class);
        $classes = explode(' ', $class);
        foreach ($classes as $class) {
            unset($this->props['class'][$class]);
        }

        return $this;
    }


    /**
     * 新增style
     *
     * @param string $style
     */
    public function addStyle($style)
    {
        $this->props['style'][] = $style;

        return $this;
    }


    /**
     * 是否是一个bool型的属性
     *
     * @param string $name
     *
     * @return boolean
     */
    protected function isBoolProp($name)
    {
        return array_key_exists($name, $this->bool_prop_list);
    }


    /**
     * build属性集。
     *
     * @param array $excludes   要排除哪些属性不处理
     */
    public function build(array $excludes = [])
    {
        // 排除表
        $ex = array_fill_keys($excludes, true);

        // 准备
        $output = [];

        // 逐一处理属性
        foreach ($this->props as $name => $value) {
            if ($value !== null) {
                // 是否是需要排除的属性
                if (array_key_exists($name, $ex)) {
                    continue;
                }

                if ($name === 'class') {
                    if ($this->props['class']) {
                        $class = implode(' ', $this->props['class']);
                        $output[] = " class=\"$class\"";
                    }
                } elseif ($name === 'style') {
                    if ($this->props['style']) {
                        $style = implode('', $this->props['style']);
                        $output[] = " style=\"$style\"";
                    }
                } elseif ($this->isBoolProp($name)) {
                    // 检查是否是bool属性
                    $output[] = " $name";
                } else {
                    // 普通属性
                    $name = htmlspecialchars($name);
                    $value = htmlspecialchars($value);
                    $output[] = " $name=\"$value\"";
                }
            }
        }

        // 返回
        $str = implode('', $output);
        return $str;
    }
}
