<?php namespace Allekslar\Series\Classes\Store\Serie;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Allekslar\Series\Models\Serie;

/**
 * Class ActiveListStore
 * @package Allekslar\Series\Classes\Store\Serie
 */
class ActiveNameListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Serie::active()->lists('name');

        return $arElementIDList;
    }
}
