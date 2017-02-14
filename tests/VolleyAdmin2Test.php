<?php

use JeroenDesloovere\VolleyAdmin2\VolleyAdmin2;

/**
 * In this class we test all generic functions from VolleyAdmin2.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class VolleyAdmin2Test extends \PHPUnit_Framework_TestCase
{
    /** @var VolleyAdmin2 */
    protected $api;

    public function setUp()
    {
        $this->api = $this
            ->getMockBuilder('JeroenDesloovere\VolleyAdmin2\VolleyAdmin2')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Test matches
     */
    public function testMatches()
    {
        /**
         * @global string $clubNumber
         * @global integer $provinceId
         * @global string $seriesId
         */
        require __DIR__ . '/../examples/credentials.php';

        $this->api
            ->expects($this->once())
            ->method('getMatches')
            ->will($this->returnValue(true));

        $matches = $this->api->getMatches(
            $seriesId,
            $provinceId,
            $clubNumber
        );
        $this->assertEquals($matches, true);
    }

    /**
     * Test series
     */
    public function testSeries()
    {
        /**
         * @global integer $provinceId
         */
        require __DIR__ . '/../examples/credentials.php';

        $this->api
            ->expects($this->once())
            ->method('getSeries')
            ->will($this->returnValue(true));

        $series = $this->api->getSeries($provinceId);
        $this->assertEquals($series, true);
    }

    /**
     * Test standings
     */
    public function testStandings()
    {
        /**
         * @global integer $provinceId
         * @global string $seriesId
         */
        require __DIR__ . '/../examples/credentials.php';

        $this->api
            ->expects($this->once())
            ->method('getStandings')
            ->will($this->returnValue(true));

        $standings = $this->api->getStandings(
            $seriesId,
            $provinceId
        );
        $this->assertEquals($standings, true);
    }
}
