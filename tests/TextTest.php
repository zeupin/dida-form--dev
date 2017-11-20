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
 * TextTest
 */
class TextTest extends TestCase
{
    public $form;


    public function test_1()
    {
        $text = new \Dida\Form\Control\Text("TEST DEMO", 'demo');
        echo Debug::varDump($text->build());
    }


    public function test_2()
    {
        $text = new \Dida\Form\Control\Text("", 'demo');
        echo Debug::varDump($text->build());
    }


    public function test_3()
    {
        $text = new \Dida\Form\Control\Text("", 'demo');
        echo Debug::varDump($text->build());
    }
}
