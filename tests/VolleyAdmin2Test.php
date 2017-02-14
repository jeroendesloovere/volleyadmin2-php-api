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
     * Test matches
     */
    public function testMatches()
    {
        $api = new VolleyAdmin2();

        /**
         * @global string $clubNumber
         * @global integer $provinceId
         * @global string $seriesId
         */
        require __DIR__ . '/../examples/credentials.php';

        $matches = $api->getMatches(
            $seriesId,
            $provinceId,
            $clubNumber
        );
        $this->assertEquals(is_array($matches), true);
    }

    /**
     * Test series
     */
    public function testSeries()
    {
        $api = new VolleyAdmin2();

        /**
         * @global integer $provinceId
         */
        require __DIR__ . '/../examples/credentials.php';

        $series = $api->getSeries($provinceId);
        $this->assertEquals(is_array($series), true);
    }

    /**
     * Test standings
     */
    public function testStandings()
    {
        $api = new VolleyAdmin2();

        /**
         * @global integer $provinceId
         * @global string $seriesId
         */
        require __DIR__ . '/../examples/credentials.php';

        $standings = $api->getStandings(
            $seriesId,
            $provinceId
        );
        $this->assertEquals(is_array($standings), true);
    }
}
