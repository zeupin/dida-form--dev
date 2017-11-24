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
 * FormException
 */
class FormException extends \Exception
{
    /**
     * Version
     */
    const VERSION = '20171123';

    // --------------------------------------------------------------------------------
    // Form 类
    // --------------------------------------------------------------------------------

    /**
     * 无效的method。
     * 1. method只准是 get/post/put/patch/delete/head/options 之一。
     */
    const INVALID_METHOD = 1001;

    /**
     * 控件类型未找到。
     */
    const CONTROL_TYPE_NOT_FOUND = 1002;

    // --------------------------------------------------------------------------------
    // OptionSet 类
    // --------------------------------------------------------------------------------

    /**
     * 数据类型无效
     * 1. checkValue()时，$data参数无效。
     */
    const DATA_TYPE_ERROR = 2001;

}
