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
     * 自动闭合元素表。
     *
     * @var array
     */
    protected $autoclose_element_list = [
        'input' => null,
    ];

    /**
     * @var string
     */
    protected $tag = '';

    /**
     * @var boolean
     */
    protected $autoclose = false;

    /**
     * @var string
     */
    protected $opentag = '';

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

    /**
     * 父节点
     * @var \Dida\Form\HtmlElement
     */
    protected $wrapper = null;

    /**
     * 兄节点
     * @var \Dida\Form\HtmlElement
     */
    protected $before = null;

    /**
     * 弟节点
     * @var \Dida\Form\HtmlElement
     */
    protected $after = null;

    /**
     * 子节点
     * @var array
     */
    protected $children = [];


    public function __construct($tag = null, $more = null)
    {
        if (!is_null($tag)) {
            $this->setTag($tag, $more);
        }
    }


    /**
     * 初始化。
     *
     * @param string $tag   标签。
     * @param boolean $autoclose   是否是自闭合。
     * @param string $more   自定义的属性。
     */
    public function setTag($tag = null, $more = null)
    {
        $this->tag = $tag;
        if ($this->tag) {
            $this->opentag = ($more) ? $this->tag . ' ' . trim($more) : $this->tag;
        } else {
            $this->opentag = '';
        }

        $this->autoclose = array_key_exists($tag, $this->autoclose_element_list);
        return $this;
    }


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
     * 设置当前元素的innerHTML。
     *
     * 注意：依照对innerHTML的定义，执行本方法后，children会被重置为空数组。
     *
     * @param string $html
     * @return $this
     */
    public function setInnerHTML($html)
    {
        $this->innerHTML = $html;
        $this->children = [];
        return $this;
    }


    /**
     * 获取当前元素的innerHTML。
     *
     * @return string
     */
    public function getInnerHTML()
    {
        return $this->innerHTML . $this->buildChildren();
    }


    /**
     * 在本元素的外面包一个元素。
     *
     * @param string $tag
     *
     * @return \Dida\Form\HtmlElement
     */
    public function &wrap($tag = 'div')
    {
        $this->wrapper = new HtmlElement($tag);
        return $this->wrapper;
    }


    /**
     * 在本元素的前面插一个元素。
     *
     * @param string $tag
     *
     * @return \Dida\Form\HtmlElement
     */
    public function &insertBefore($tag = null)
    {
        $this->before = new HtmlElement($tag);
        return $this->before;
    }


    /**
     * 在本元素的后面插一个元素。
     *
     * @param string $tag
     *
     * @return \Dida\Form\HtmlElement
     */
    public function &insertAfter($tag = null)
    {
        $this->after = new HtmlElement($tag);
        return $this->after;
    }


    /**
     * 新增一个子节点。
     *
     * @param  $tag
     * @return \Dida\Form\HtmlElement
     */
    public function &addChild($tag = null)
    {
        $element = new HtmlElement($tag);
        $this->children[] = &$element;
        return $element;
    }


    /**
     * 构建元素的属性表达式
     */
    protected function buildProps()
    {
        $output = [];

        // id
        if ($this->id) {
            $output[] = ' id="' . htmlspecialchars($this->id) . '"';
        }

        // name
        if ($this->name) {
            $output[] = ' name="' . htmlspecialchars($this->name) . '"';
        }

        // class
        if ($this->class) {
            $output[] = ' class="' . htmlspecialchars($this->class) . '"';
        }

        // properties
        foreach ($this->props as $name => $value) {
            if (array_key_exists($name, $this->bool_prop_list)) {
                $output[] = ' ' . htmlspecialchars($name);
            } else {
                $output[] = ' ' . htmlspecialchars($name) . '="' . htmlspecialchars($value) . '"';
            }
        }

        // style
        if ($this->style) {
            $output[] = ' style="' . implode('', $this->style) . '"';
        }

        // result
        return implode('', $output);
    }


    protected function buildChildren()
    {
        /**
         * 如果没有子节点
         */
        if (empty($this->children)) {
            return '';
        }

        /**
         * 合并子节点
         */
        $output = [];
        foreach ($this->children as $element) {
            $output[] = $element->build();
        }
        return implode('', $output);
    }


    protected function buildSelf()
    {
        // 如果没有设置tag，只要返回innerHTML即可。
        if (!$this->tag) {
            return $this->getInnerHTML();
        }

        // 如果是自闭合元素
        if ($this->autoclose) {
            return "<" . $this->opentag . $this->buildProps() . '>';
        }

        // 如果是普通元素
        return "<" . $this->opentag . $this->buildProps() . '>' . $this->getInnerHTML() . "</{$this->tag}>";
    }


    public function build()
    {
        $output = [];

        // before
        if (!is_null($this->before)) {
            $output[] = $this->before->build();
        }
        // self
        $output[] = $this->buildSelf();
        // after
        if (!is_null($this->after)) {
            $output[] = $this->after->build();
        }
        // implode
        $result = implode('', $output);

        // 是否有wrapper
        if (is_null($this->wrapper)) {
            return $result;
        } else {
            $this->wrapper->innerHTML = &$result;
            return $this->wrapper->build();
        }
    }
}
