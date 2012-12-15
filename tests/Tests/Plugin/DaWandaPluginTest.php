<?php
/**
 * DaWandaPluginTest.php
 *
 * @author tploch
 * @since  07.12.12 07:14
 * @filesource
 */
namespace DaWanda\Tests\Plugin;

use Guzzle\Tests\GuzzleTestCase;

use Guzzle\Http\QueryString;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Client;
use Guzzle\Common\Collection;

use DaWanda\Plugin\DaWandaPlugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Client tests
 */
class DaWandaPluginTest extends GuzzleTestCase
{
    /**
     * @var \DaWanda\Plugin\DaWandaPlugin
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
    }

    /**
     * Tests correct event emitting
     *
     * @return void
     */
    public function testEmittedEventName()
    {
        $expected = array(
            'request.before_send'   => 'onBeforeSend'
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
}
