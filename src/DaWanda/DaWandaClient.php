<?php
/**
 * DaWandaClient.php
 *
 * @author   Thomas Ploch <tp@responsive-code.de>
 * @since    06.12.12 21:40
 * @licenese MIT
 *
 * @filesource
 *
 */
namespace Guzzle\Dawanda;

use Guzzle\Common\Event;
use Guzzle\Common\Collection;
use Guzzle\Common\Exception\InvalidArgumentException;
use Guzzle\Common\Exception\RuntimeException;

use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Service\Client;

use Guzzle\Http\Message\Request;

use Guzzle\DaWanda\Plugin\DaWandaPlugin;

/**
 * The DaWanda API Client
 *
 * @package    Guzzle
 * @subpackage DaWanda
 */
class DaWandaClient extends Client
{
    /**
     * Factory method to create a new DaWandaClient
     *
     * The following array keys and values are available options:
     * - base_url: Base URL of web service
     * - language:   Language: 'de', 'en' or 'fr'
     * - api_key: The DaWanda API key
     * - version: API version (currently only 1 is implemented)
     *
     * @param array|Collection $config Configuration data
     *
     * @return self
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url' => 'https://{language}.dawanda.com/api/{version}/',
            'language' => 'en',
            'version'  => 'v1',
            'format'   => 'json',
            'service'  => __DIR__ . DIRECTORY_SEPARATOR . 'DaWanda.json'
        );
        $required = array('language', 'version', 'base_url', 'api_key', 'service');
        $config = Collection::fromConfig($config, $default, $required);

        $validLanguages = array('en', 'de', 'fr');
        if (!in_array($config->get('language'), $validLanguages)) {
            throw new InvalidArgumentException(
                "Invalid language: Valid languages are 'de' (German), 'en' (English) and 'fr' (French), '{$config->get('language')}' given.");
        }

        if ($config->get('version') !== 'v1') {
            throw new InvalidArgumentException(
                "Invalid version: currently only version 'v1' is implemented, '{$config->get('language')}' given.");
        }

        $client = new self($config->get('base_url'), $config);
        $client->setDescription(ServiceDescription::factory($config->get('service')));
        $client->addSubscriber(new DaWandaPlugin($config->get('api_key')));
        $client->setSslVerification(false, false);

        return $client;
    }

    /**
     * @param $keyword
     */
    public function searchUsers($keyword)
    {
        $command = $this->getCommand('SearchUsers', array('keyword' => $keyword));
        $command
            ->prepare()
            ->getQuery()
            ->add('keyword', $keyword)
        ;

        return $command->execute();
    }
}
