<?php

use COREPOS\pos\lib\FormLib;

class Test extends PHPUnit_Framework_TestCase
{
    public function testPlugin()
    {
        $obj = new WedgeStaffCharge();
        $obj->plugin_transaction_reset();
        $obj->pluginEnable();
        $obj->pluginDisable();
    }

    public function testParser()
    {
        $c = new CaseDiscount();
        $this->assertEquals(true, $c->check('10CT10'));
        $this->assertEquals(false, $c->check('5*10CT10'));
        $this->assertEquals('10', $c->parse('10CT10'));

        $c = new ClubCard();
        $this->assertEquals(true, $c->check('50JC'));
        $this->assertEquals(false, $c->check('foo'));
        $this->assertInternalType('array', $c->parse('50JC'));

        $c = new CaseDiscMsgs();
        $this->assertEquals(true, $c->check('cdinvalid'));
        $this->assertEquals(false, $c->check('foo'));
        $this->assertInternalType('array', $c->parse('cdinvalid'));

        $p = new WedgeScParser();
        $this->assertEquals(false, $p->check('1234SC'));
        $this->assertEquals(false, $p->check('1234'));
        $this->assertEquals(true, $p->check('123456SC'));
        $this->assertInternalType('array', $c->parse('123456SC'));
    }

    public function testSpecial()
    {
        $s = new MagicPLU();
        $this->assertEquals(true, $s->isSpecial('0000000008005'));
        $this->assertEquals(false, $s->isSpecial('1000000008005'));
        $this->assertInternalType('array', $s->handle('0000000008005', array()));
    }
}

