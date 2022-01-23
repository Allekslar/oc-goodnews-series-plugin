<?php namespace Allekslar\Series\Classes\Collection;

use Lovata\Toolbox\Classes\Collection\ElementCollection;
use Allekslar\Series\Classes\Item\SerieItem;
use Allekslar\Series\Classes\Store\SerieListStore;

/**
 * Class SerieCollection
 * @package Allekslar\Series\Classes\Collection
 */
class SerieCollection extends ElementCollection
{
    const ITEM_CLASS = SerieItem::class;

    /**
     * Apply filter by active field
     * @return $this
     */
    public function active()
    {
        $arResultIDList = SerieListStore::instance()->active->get();

        return $this->intersect($arResultIDList);
    }

    /**
     * Sort list
     * @return $this
     */
    public function tree()
    {
        $arResultIDList = SerieListStore::instance()->top_level->get();

        return $this->applySorting($arResultIDList);
    }

    /**
     * Get item by code
     * @param string $sCode
     * @return SerieItem
     */
    public function getByCode($sCode)
    {
        if ($this->isEmpty() || empty($sCode)) {
            return SerieItem::make(null);
        }

        $arSerieList = $this->all();

        /** @var SerieItem $obSerieItem */
        foreach ($arSerieList as $obSerieItem) {
            if ($obSerieItem->code == $sCode) {
                return $obSerieItem;
            }
        }

        return SerieItem::make(null);
    }
}
