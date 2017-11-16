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
 * PropertyTrait
 */
trait PropertyTrait
{
    /**
     * @var array
     */
    protected $properties = [
        'id'   => null,
        'name' => null,
    ];

    /**
     * 布尔属性的列表
     *
     * @var array
     */
    protected $bool_prop_list = [
        'readonly'       => null,
        'disabled'       => null,
        'required'       => null,
        'hidden'         => null,
        'checked'        => null,
        'selected'       => null,
        'autofocus'      => null,
        'multiple'       => null,
        'formnovalidate' => null,
    ];


    /**
     * 设置一个属性值。
     *
     * @param string $name
     * @param mixed $value
     *
     * @throws FormException
     */
    public function setProp($name, $value)
    {
        // 属性名是否合法
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        // 属性值是否合法
        if (!is_scalar($value)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_VALUE);
        }

        // 属性名转小写
        $name = strtolower($name);

        // 如果$value为null，删除属性
        if ($value === null) {
            unset($this->properties[$name]);
            return $this;
        }

        // 如果是布尔型的属性
        if (array_key_exists($name, $this->bool_prop_list)) {
            if ($value && ($value !== 'false')) {
                $this->properties[$name] = true;
            } else {
                unset($this->properties[$name]);
            }
            return $this;
        }

        // 一般的属性，则设置值
        $this->properties[$name] = $value;

        return $this;
    }


    /**
     * 获取一个属性值。
     *
     * @param string $name
     *
     * @return mixed|null
     */
    public function getProp($name)
    {
        // 属性名是否合法
        if (!is_string($name)) {
            throw new FormException($name, FormException::INVALID_PROPERTY_NAME);
        }

        // 属性名转小写
        $name = strtolower($name);

        // 如果是布尔型的属性
        if (array_key_exists($name, $this->bool_prop_list)) {
            return array_key_exists($name, $this->properties);
        }

        // 如果属性存在，返回属性值，不存在返回null
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        } else {
            return null;
        }
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
}
