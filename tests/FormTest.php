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
        $this->assertGreaterThan(0, $pos);
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
        $this->assertGreaterThan(0, $pos);
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
        $this->assertGreaterThan(0, $pos);
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
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_1()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<select name="currency"><option>CNY</option><option>USD</option><option>JPY</option><option>AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_2()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD']);
        $control->setValues(['cny', 'usd', null, 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<select name="currency"><option value="cny">CNY</option><option value="usd">USD</option><option>JPY</option><option value="aud">AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_3()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->setValues(['cny', 'usd', null, 'aud'])
            ->check('cny');
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<select name="currency"><option value="cny" selected>CNY</option><option value="usd">USD</option><option>JPY</option><option value="aud">AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_4()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->setValues(['cny', 'usd', null, 'aud'])
            ->check(['cny', 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<option value="cny" selected>CNY</option><option value="usd">USD</option><option>JPY</option><option value="aud" selected>AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_5()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['cny', 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<option>CNY</option><option>USD</option><option>JPY</option><option>AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_6()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['USD', 'JPY']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<option>CNY</option><option selected>USD</option><option selected>JPY</option><option>AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_checkboxgroup_1()
    {
        $form = new Form();
        $control = $form->add('checkboxgroup', 'currency');
        $control->label("币种");
        $control->setCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['USD', 'JPY']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<input type="checkbox" name="currency___0">CNY</option><input type="checkbox" name="currency___1" checked>USD</option><input type="checkbox" name="currency___2" checked>JPY</option><input type="checkbox" name="currency___3">AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }
}
