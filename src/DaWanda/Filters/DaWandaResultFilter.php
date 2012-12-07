<?php
/**
 * DaWandaResultFilter file
 *
 * @author tploch
 * @since  07.12.12 16:26
 */
namespace Guzzle\DaWanda\Filters;

/**
 * The DaWandaResultFilter
 *
 * @package    DaWanda
 * @subpackage Filters
 */
class DaWandaResultFilter
{
    /**
     * @param $resultNode
     *
     * @static
     */
    public static function filterResultNode($resultNode)
    {
        $users = $resultNode['result']['users'];
        unset($resultNode['result']);

        $resultNode['users'] = $users;

        return $resultNode;
    }
}
