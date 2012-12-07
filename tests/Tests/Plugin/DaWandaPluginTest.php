<?php
/**
 * DaWandaPluginTest.php
 *
 * @author tploch
 * @since  07.12.12 07:14
 * @filesource
 */
namespace Guzzle\DaWanda\Tests\Plugin;

use Guzzle\Tests\GuzzleTestCase;

use Guzzle\Common\Event;
use Guzzle\Http\QueryString;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Client;
use Guzzle\Common\Collection;

use Guzzle\DaWanda\Plugin\DaWandaPlugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Client tests
 */
class DaWandaPluginTest extends GuzzleTestCase
{
    /**
     * @var \Guzzle\DaWanda\Plugin\DaWandaPlugin
     */
    public $plugin;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $event;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $query;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $request;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $client;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    public $collection;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->plugin = new DaWandaPlugin('testkey');

        $this->event = $this
            ->getMockBuilder('Guzzle\Common\Event')
            ->setMethods(array('offsetGet'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->query = $this
            ->getMockBuilder('Guzzle\Http\QueryString')
            ->setMethods(array('set'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->request = $this
            ->getMockBuilder('Guzzle\Http\Message\Request')
            ->setMethods(array('getQuery'))
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->client = $this
            ->getMockBuilder('Guzzle\Http\Client')
            ->disableOriginalConstructor()
            ->setMethods(array('getConfig'))
            ->getMock()
        ;

        $this->collection = $this
            ->getMockBuilder('Guzzle\Common\Collection')
            ->setMethods(array('get'))
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }

    /**
     * Tests correct event emitting
     *
     * @return void
     */
    public function testEmittedEventName()
    {
        $expected = array(
            'request.before_send'   => 'onBeforeSend',
            'client.create_request' => 'onRequestCreate'
        );
        $this->assertEquals($expected, DaWandaPlugin::getSubscribedEvents());
    }

    /**
     * Tests that the correct interface is implemented
     *
     * @return void
     */
    public function testImplementsSubscriberInterface()
    {
        $this->assertInstanceOf('Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->plugin);
    }

    /**
     * Tests that onBeforeSend does the right thing with the Request object
     *
     * @return void
     */
    public function testOnBeforeSend()
    {
        $this->event
            ->expects($this->once())
            ->method('offsetGet')
            ->with('request')
            ->will($this->returnValue($this->request))
        ;

        $this->request
            ->expects($this->once())
            ->method('getQuery')
            ->will($this->returnValue($this->query))
        ;

        $this->query
            ->expects($this->once())
            ->method('set')
            ->with('api_key', 'testkey')
        ;

        $this->plugin->onBeforeSend($this->event);
    }

    /**
     * Tests that onBeforeSend does the right thing with the Request object
     *
     * @return void
     */
    public function testOnRequestCreate()
    {
        $this->client->setConfig($this->collection);

        $this->collection
            ->expects($this->once())
            ->method('get')
            ->with('format')
            ->will($this->returnValue('json'))
        ;

        $this->request
            ->expects($this->once())
            ->method('getQuery')
            ->will($this->returnValue($this->query))
        ;

        $this->query
            ->expects($this->once())
            ->method('set')
            ->with('format', 'json')
        ;

        $this->event
            ->expects($this->at(0))
            ->method('offsetGet')
            ->with('client')
            ->will($this->returnValue($this->client))
        ;

        $this->event
            ->expects($this->at(1))
            ->method('offsetGet')
            ->with('request')
            ->will($this->returnValue($this->request))
        ;

        $this->plugin->onRequestCreate($this->event);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        unset($this->query, $this->request, $this->collection, $this->client, $this->event);
    }
}
