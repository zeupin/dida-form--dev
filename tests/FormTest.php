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
            ->add('hidden', 'time', time())
            ->setProp('id', 'abcd')
            ->setProp('style', '1111')
            ->done()
            ->add('hidden', 'token', uniqid());
        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_text()
    {
        $form = new Form();
        $text = $form->add('text', 'name')
            ->label("姓名")
            ->setValue('your name')
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_password()
    {
        $form = new Form();
        $text = $form->add('password', 'pwd', '')
            ->label("密码")
            ->setValue('your password')
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_textarea()
    {
        $form = new Form();
        $text = $form->add('textarea', 'content', 'id_content')
            ->label("介绍")
            ->cols(40)->rows(5)
            ->setValue("你的介绍")
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }
}
