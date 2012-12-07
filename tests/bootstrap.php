<?php
// Include the composer autoloader
$loader = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Register services with the GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . DIRECTORY_SEPARATOR . 'mock');

Guzzle\Tests\GuzzleTestCase::setServiceBuilder(\Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'test.dawanda.invalid.lang' => array(
        'class' => 'Guzzle\\Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'foooo',
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.no.key' => array(
        'class' => 'Guzzle\\Dawanda\\DaWandaClient',
        'params' => array()
    ),
    'test.dawanda.de' => array(
        'class' => 'Guzzle\\Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'de',
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.en' => array(
        'class' => 'Guzzle\\Dawanda\\DaWandaClient',
        'params' => array(
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.fr' => array(
        'class' => 'Guzzle\\Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'fr',
            'api_key'  => $_SERVER['API_KEY']
        )
    )
)));
