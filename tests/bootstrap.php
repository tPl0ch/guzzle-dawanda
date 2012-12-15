<?php
// Include the composer autoloader
$loader = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Register default mock response directory
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . DIRECTORY_SEPARATOR . 'mock');

// Register services with the GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setServiceBuilder(\Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'test.dawanda.invalid.lang' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'foooo',
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.invalid.version' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'version' => '30',
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.no.key' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array()
    ),
    'test.dawanda.no.desc' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'service' => 'nonexistant.php'
        )
    ),
    'test.dawanda.de' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'de',
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.en' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'api_key'  => $_SERVER['API_KEY']
        )
    ),
    'test.dawanda.fr' => array(
        'class' => 'Dawanda\\DaWandaClient',
        'params' => array(
            'language' => 'fr',
            'api_key'  => $_SERVER['API_KEY']
        )
    )
)));
