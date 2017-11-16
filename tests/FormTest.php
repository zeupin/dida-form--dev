<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

/**
 * use
 */
use \PHPUnit\Framework\TestCase;
use \Dida\Debug\Debug;
use \Dida\Form\Form;

/**
 * FormTest
 */
class FormTest extends TestCase
{
    public $form;


    public function test_form()
    {
        $form = (new Form())
            ->setMethod('delete');
        $html = $form->build();
        echo Debug::varDump($html);
    }
}
