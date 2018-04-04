<?php

/**
 * VolleyAdmin2
 *
 * This VolleyAdmin2 PHP Class connects to the VolleyAdmin2 API.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */

// Add your own credentials in this file
require_once __DIR__ . '/credentials.php';

// Required to load (only when not using an autoloader)
require_once __DIR__ . '/../vendor/autoload.php';

use JeroenDesloovere\VolleyAdmin2\VolleyAdmin2;

// Init API
$api = new VolleyAdmin2();

// Define all series
$series = $api->getSeries($provinceId);

foreach ($series as $serie) {
    var_dump($serie);
}
