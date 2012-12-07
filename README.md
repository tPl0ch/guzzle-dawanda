Guzzle DaWanda API v1
=====================

A basic Guzzle implementation of the DaWanda API v1.
This is only implementing the Basic API, I am currently working on extending it with more features and writing the OAuth Provider.

## Installation

#### Composer

Require the following package in your composer.json

    require: {
        ...
        "tp/guzzle-dawanda": "dev-master",
        ...
    }

#### Get an API key over at DaWanda

Fetch it here:
http://www.dawanda.com/apps


## Usage

There are 3 available languages supported by DaWanda at the moment, 'de', 'en' and 'fr'.

```php
<?php
use Guzzle\DaWanda\DaWandaClient;

// Get the client using the factory
$client = DaWandaClient::factory(array(
    'language' => 'en', // default
    'api_key'  => '******', // Your API key here
    'format'   => 'json' // or 'xml'
));

// Use the client
$result = $client->SearchUsers(array(
    'keyword'  => 'Liebe-und-Kraft'
));

// Pagination
$result = $client->SearchUsers(array(
    'keyword'  => 'Liebe-und-Kraft',
    'per_page' => 30, // default is 10
    'page'     => 3   // Third page, default is 1
));

```

See https://github.com/tPl0ch/guzzle-dawanda/blob/master/src/DaWanda/DaWanda.json for all supported methods


## TODO

 * Add ResourceIterator for easily abstracting away pagination
 * Add Models so reusing the result objects is more fun
 * Increase test coverage

## Further Reading

The documentation over at guzzle is pretty informative, too, so check it out:
http://guzzlephp.org/docs.html
