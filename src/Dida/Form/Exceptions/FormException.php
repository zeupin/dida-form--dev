<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Form\Exceptions;

/**
 * FormException
 */
class FormException extends \Exception
{
    /**
     * Version
     */
    const VERSION = '20171116';

    //////////////////////////////////////////////////////////
    // Form 类
    //////////////////////////////////////////////////////////

    /**
     * 无效的method。
     *
     * 一个有效的method只能是 get/post/put/patch/delete/head/options 之一。
     */
    const INVALID_METHOD = 1001;

    //////////////////////////////////////////////////////////
    // FormControl 类
    //////////////////////////////////////////////////////////

    /**
     * 表单控件的属性名无效
     */
    const INVALID_PROPERTY_NAME = 2001;

    /**
     * 表单控件的属性值无效
     */
    const INVALID_PROPERTY_VALUE = 2002;

}
