<?php namespace Allekslar\Series\Classes\Store;

use Lovata\Toolbox\Classes\Store\AbstractListStore;
use Allekslar\Series\Classes\Store\Serie\ActiveListStore;
use Allekslar\Series\Classes\Store\Serie\TopLevelListStore;
use Allekslar\Series\Classes\Store\Serie\ActiveNameListStore;

/**
 * Class SerieListStore
 * @package Allekslar\Series\Classes\Store
 * @property ActiveListStore  $active
 * @property TopLevelListStore $top_level
 */
class SerieListStore extends AbstractListStore
{
    protected static $instance;

    /**
     * Init store method
     */
    protected function init()
    {
        $this->addToStoreList('active', ActiveListStore::class);
        $this->addToStoreList('top_level', TopLevelListStore::class);
        $this->addToStoreList('active_name', ActiveNameListStore::class);
    }
}
