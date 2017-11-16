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
 * FormControl
 */
abstract class FormControl
{
    /**
     * Version
     */
    const VERSION = '20171116';


    /**
     * 属性的设置和读取
     */
    use PropertyTrait;


    /**
     * build当前control
     */
    abstract public function build();
}
