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
        $control = new \Dida\Form\Control\Text("TEST DEMO", 'demo');
        echo Debug::varDump($control->build());
    }


    public function test_2()
    {
        $control = new \Dida\Form\Control\Text("", 'demo');
        echo Debug::varDump($control->build());
    }


    public function test_3()
    {
        $control = new \Dida\Form\Control\Text("", 'demo');
        $control->refCaptionZone()->wrap('div')->setClass('div1');
        echo Debug::varDump($control->build());
    }
}
