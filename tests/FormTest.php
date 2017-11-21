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
            ->add('hidden', 'time', time(), "SHI JIAN", 'id' . uniqid())->done()
            ->add('hidden', null, 'token', uniqid());
        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_text()
    {
        $form = new Form();
        $control = $form->add('text', 'name', 'your name', 'XING MING', 'id' . uniqid());

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_password()
    {
        $form = new Form();
        $control = $form->add('password', 'pwd', '', 'MIMA', 'pwd')
            ->setData('your password')
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_textarea()
    {
        $form = new Form();
        $control = $form->add('textarea', 'content', null, 'TEXT AREA', 'id_content')
            ->setRowsAndCols(5, 40)
            ->setData("Your Text")
            ->required();

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_button()
    {
        $form = new Form();
        $control = $form->add('button')
            ->setCaption("your intro")
            ->setData("your content");

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_reset()
    {
        $form = new Form();
        $control = $form->add('reset')
            ->setCaption("your intro")
            ->setData("your content");

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_submit()
    {
        $form = new Form();
        $control = $form->add('submit')
            ->setCaption("your intro")
            ->setData("your content");

        $html = $form->build();
        echo Debug::varDump($html);
    }


    public function test_radiogroup_0()
    {
        $form = new Form();
        $control = $form->add('radiogroup', 'gender')
            ->setCaption("Gender")
            ->setOptionCaptions(['male', 'female'])
            ->setOptionValues([1, 0])
            ->setData(1);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<label><input type="radio" name="gender" value="1" checked>male</label><label><input type="radio" name="gender" value="0">female</label>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_radiogroup_1()
    {
        $form = new Form();
        $control = $form->add('radiogroup', 'gender')
            ->setCaption("Gender")
            ->setOptionCaptions(['male', 'female'])
            ->setOptionValues([1, 0]);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<label><input type="radio" name="gender" value="1">male</label><label><input type="radio" name="gender" value="0">female</label>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_statictext_1()
    {
        $form = new Form();
        $control = $form->add('statictext')
            ->setCaption("STATIC TEXT")
            ->setData('some words');

        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<div>STATIC TEXT</div><div>some words</div>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_1()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<select name="currency"><option>CNY</option><option>USD</option><option>JPY</option><option>AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_2()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD']);
        $control->setOptionValues(['cny', 'usd', null, 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, '<select name="currency"><option value="cny">CNY</option><option value="usd">USD</option><option>JPY</option><option value="aud">AUD</option></select>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_3()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->setOptionValues(['cny', 'usd', null, 'aud'])
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
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->setOptionValues(['cny', 'usd', null, 'aud'])
            ->check(['cny', 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, ''
            . '<option value="cny" selected>CNY</option>'
            . '<option value="usd">USD</option>'
            . '<option>JPY</option>'
            . '<option value="aud" selected>AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_5()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['cny', 'aud']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, ''
            . '<option>CNY</option>'
            . '<option>USD</option>'
            . '<option>JPY</option>'
            . '<option>AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_select_6()
    {
        $form = new Form();
        $control = $form->add('select', 'currency');
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['USD', 'JPY']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, ''
            . '<option>CNY</option>'
            . '<option selected>USD</option>'
            . '<option selected>JPY</option>'
            . '<option>AUD</option>');
        $this->assertGreaterThan(0, $pos);
    }


    public function test_checkboxgroup_1()
    {
        $form = new Form();
        $control = $form->add('checkboxgroup', 'currency');
        $control->setCaption("Currency");
        $control->setOptionCaptions(['CNY', 'USD', 'JPY', 'AUD'])
            ->check(['USD', 'JPY']);
        $html = $form->build();
        echo Debug::varDump($html);

        $pos = mb_strpos($html, ''
            . '<label><input type="checkbox" name="currency___0">CNY</label>'
            . '<label><input type="checkbox" name="currency___1" checked>USD</label>'
            . '<label><input type="checkbox" name="currency___2" checked>JPY</label>'
            . '<label><input type="checkbox" name="currency___3">AUD</label>');
        $this->assertGreaterThan(0, $pos);
    }
}
