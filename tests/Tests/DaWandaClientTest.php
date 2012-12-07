<?php
/**
 * DaWandaClientTest.php
 *
 * @author tploch
 * @since  07.12.12 06:02
 * @filesource
 */
namespace Guzzle\DaWanda\Tests;

use Guzzle\Tests\GuzzleTestCase;

/**
 * Client tests
 */
class DaWandaClientTest extends GuzzleTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        // (ﾉಥ益ಥ）ﾉ﻿ ┻━┻
    }

    /**
     * Tests that invalid constructors throw right exceptions
     *
     * @expectedException PHPUnit_Framework_Error
     *
     * @return void
     */
    public function testInvalidConstructors()
    {
        $this->getServiceBuilder()->get('test.dawanda.no.key');
    }
}
