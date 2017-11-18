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
        $control = $form->add('text', 'name')
            ->label("姓名")
            ->value('your name')
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_password()
    {
        $form = new Form();
        $control = $form->add('password', 'pwd', '')
            ->label("密码")
            ->value('your password')
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_textarea()
    {
        $form = new Form();
        $control = $form->add('textarea', 'content', 'id_content')
            ->label("介绍")
            ->cols(40)->rows(5)
            ->value("你的介绍")
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_button()
    {
        $form = new Form();
        $control = $form->add('button', null, null)
            ->label("介绍")
            ->value("你的介绍");

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_reset()
    {
        $form = new Form();
        $control = $form->add('reset', null, null);

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_submit()
    {
        $form = new Form();
        $control = $form->add('submit', null, null);

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_radiogroup_0()
    {
        $form = new Form();
        $control = $form->add('radiogroup', 'gender')
            ->label("性别")
            ->value(1)
            ->options([
            '男' => 1,
            '女' => 0,
        ]);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<input type="radio" name="gender" value="1" checked>男<input type="radio" name="gender" value="0">女');
        $this->assertGreaterThanOrEqual(0, $pos);
    }


    public function test_radiogroup_1()
    {
        $form = new Form();
        $control = $form->add('radiogroup', 'gender')
            ->label("性别")
            ->options(['male', 'female',]);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<input type="radio" name="gender" value="male">male<input type="radio" name="gender" value="female">female');
        $this->assertGreaterThanOrEqual(0, $pos);
    }


    public function test_radiogroup_2()
    {
        $form = new Form();
        $control = $form->add('radiogroup', 'gender')
            ->label("性别")
            ->defaultValue(0)
            ->options([
            '男' => 1,
            '女' => 0,
        ]);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<input type="radio" name="gender" value="0" checked>');
        $this->assertGreaterThanOrEqual(0, $pos);
    }


    public function test_statictext_1()
    {
        $form = new Form();
        $control = $form->add('statictext')
            ->label("STATIC TEXT")
            ->value('some words');

        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<label>STATIC TEXT</label>some words');
        $this->assertGreaterThanOrEqual(0, $pos);
    }
}
