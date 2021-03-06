<?php
/**
 * DaWandaClientTest.php
 *
 * @author tploch
 * @since  07.12.12 06:02
 * @filesource
 */
namespace DaWanda\Tests;

use Guzzle\Tests\GuzzleTestCase;
use Dawanda\DaWandaClient;

/**
 * Client tests
 */
class DaWandaClientTest extends GuzzleTestCase
{
    /**
     * @var \Dawanda\DaWandaClient
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
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
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
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
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
     * @expectedException \Guzzle\Service\Exception\ServiceNotFoundException
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
     * @expectedException \Guzzle\Common\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function testInvalidVersion()
    {
        $this->getServiceBuilder()->get('test.dawanda.invalid.version');
    }

    /**
     * Testing error handling for 404 request
     *
     * @expectedException \Guzzle\Http\Exception\ClientErrorResponseException
     * @expectedExceptionMessage "No user with __INVALID__ could be found."
     *
     * @return void
     */
    public function testErrorSearchUsers()
    {
        $this->client = $this->getServiceBuilder()->get('test.dawanda.de');
        $this->setMockResponse($this->client, 'users.search.404.mock');

        $this->client->SearchUsers(array('keyword' => 'test'));
    }
}
