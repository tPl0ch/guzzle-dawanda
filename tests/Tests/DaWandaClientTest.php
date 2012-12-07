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
use Guzzle\Dawanda\DaWandaClient;

/**
 * Client tests
 */
class DaWandaClientTest extends GuzzleTestCase
{
    /**
     * @var \Guzzle\Dawanda\DaWandaClient
     */
    public $client;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tests api options missing throw right exception
     *
     * @expectedException Guzzle\Common\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function testInvalidNoKey()
    {
        $this->getServiceBuilder()->get('test.dawanda.no.key');
    }

    /**
     * Tests invalid language throw right exception
     *
     * @expectedException Guzzle\Common\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function testInvalidLang()
    {
        $this->getServiceBuilder()->get('test.dawanda.invalid.lang');
    }

    /**
     * Tests no service description throw right exception
     *
     * @expectedException Guzzle\Service\Exception\ServiceNotFoundException
     *
     * @return void
     */
    public function testInvalidNoDescription()
    {
        $this->getServiceBuilder()->get('test.dawanda.no.description');
    }

    /**
     * Tests no service description throw right exception
     *
     * @expectedException Guzzle\Common\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function testInvalidVersion()
    {
        $this->getServiceBuilder()->get('test.dawanda.invalid.version');
    }

    /**
     * @group internet
     *
     * @return void
     */
    public function testClient()
    {
        $this->client = $this->getServiceBuilder()->get('test.dawanda.de');
        $result = $this->client->SearchUsers(array('keyword' => 'Liebe-und-Kraft'));
        print_r($result);
    }
}
