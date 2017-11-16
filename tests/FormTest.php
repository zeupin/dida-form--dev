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
        $form = new Form();
        $form->setMethod('delete')
            ->addHidden('time', time())
            ->setProp('id', 'abcd')
            ->setProp('style', '1111')
            ->done()
            ->addHidden('token', uniqid());
        $html = $form->build();
        echo Debug::varDump($html);
    }
}
