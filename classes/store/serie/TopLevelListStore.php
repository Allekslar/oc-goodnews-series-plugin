<?php namespace Allekslar\Series\Classes\Store\Serie;

use Lovata\Toolbox\Classes\Store\AbstractStoreWithoutParam;
use Allekslar\Series\Models\Serie;

/**
 * Class TopLevelListStore
 * @package Allekslar\Series\Classes\Store\Serie
*/
class TopLevelListStore extends AbstractStoreWithoutParam
{
    protected static $instance;

    /**
     * Get ID list from database
     * @return array
     */
    protected function getIDListFromDB() : array
    {
        $arElementIDList = (array) Serie::where('nest_depth', 0)
            ->orderBy('nest_left', 'asc')
            ->lists('id');

        return $arElementIDList;
    }
    
}
