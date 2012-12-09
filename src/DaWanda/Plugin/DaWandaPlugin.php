<?php
/**
 * DaWandaPlugin.php
 *
 * @author tploch
 * @since  06.12.12 23:38
 * @filesource
 */
namespace Guzzle\DaWanda\Plugin;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Guzzle\Common\Event;
use Guzzle\Common\Collection;

/**
 * DaWanda Plugin
 */
class DaWandaPlugin implements EventSubscriberInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = (string) $key;
    }

    /**
     * {@inheritDic}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.before_send'   => 'onBeforeSend'
        );
    }

    /**
     * @param \Guzzle\Common\Event $event
     */
    public function onBeforeSend(Event $event)
    {
        $event['request']
            ->getQuery()
            ->set('api_key', $this->key)
        ;
    }
}
