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
        $control = new \Dida\Form\Control\Text('demo');
        echo Debug::varDump($control->build());
    }


    public function test_2()
    {
        $control = new \Dida\Form\Control\Text('demo', '1234');
        echo Debug::varDump($control->build());
    }


    public function test_3()
    {
        $control = new \Dida\Form\Control\Text('demo', '1234', 'DEMO CAPTION');
        $control->refCaptionZone()
            ->wrap('div')->setClass('div1')
            ->wrap()->setClass('div2');
        echo Debug::varDump($control->build());
    }


    public function test_4()
    {
        $control = new \Dida\Form\Control\Text('demo');
        $control->setData('1234');
        echo Debug::varDump($control->build());
    }
}
