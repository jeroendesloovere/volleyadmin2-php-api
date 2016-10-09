<?php

use JeroenDesloovere\VolleyAdmin2\VolleyAdmin2;

/**
 * In this class we test all generic functions from VolleyAdmin2.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class VolleyAdmin2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testEchoPhrase()
    {
        $myObj = new VolleyAdmin2();

        $res = $myObj->echoPhrase('foo');
        $this->assertEquals($res, 'foo');
    }
}
