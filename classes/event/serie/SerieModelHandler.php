<?php namespace Allekslar\Series\Classes\Event\Serie;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Allekslar\Series\Models\Serie;
use Allekslar\Series\Classes\Item\SerieItem;
use Allekslar\Series\Classes\Store\SerieListStore;

/**
 * Class SerieModelHandler
 * @package Allekslar\Series\Classes\Event\Serie
 */
class SerieModelHandler extends ModelHandler
{
    const EVENT_UPDATE_SORTING = 'series.serie.update.sorting';

    /** @var Serie */
    protected $obElement;

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Serie::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return SerieItem::class;
    }

    /**
     * Add listeners
     * @param \Illuminate\Events\Dispatcher $obEvent
     */
    public function subscribe($obEvent)
    {
        parent::subscribe($obEvent);

        $obEvent->listen(self::EVENT_UPDATE_SORTING, function () {
            SerieListStore::instance()->top_level->clear();

            //Get category ID list
            $arSerieIDList = Serie::lists('id');
            if (empty($arSerieIDList)) {
                return;
            }

            //Clear cache for all
            foreach ($arSerieIDList as $iSerieID) {
                SerieItem::clearCache($iSerieID);
            }
        });
    }

    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();

        $this->checkFieldChanges('active', SerieListStore::instance()->active);
        SerieListStore::instance()->top_level->clear();
        SerieListStore::instance()->active_name->clear();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        if ($this->obElement->active) {
            SerieListStore::instance()->active->clear();
        }

        SerieListStore::instance()->top_level->clear();

        //Clear parent item cache
        if (!empty($this->obElement->parent_id)) {
            SerieItem::clearCache($this->obElement->parent_id);
        }
    }
}
