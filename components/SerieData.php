<?php namespace Allekslar\Series\Components;

use Lovata\Toolbox\Classes\Component\ElementData;
use Allekslar\Series\Classes\Item\SerieItem;

/**
 * Class SerieData
 * @package Allekslar\Series\Components
 */
class SerieData extends ElementData
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'allekslar.series::lang.component.serie_data_name',
            'description' => 'allekslar.series::lang.component.serie_data_description',
        ];
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @return SerieItem
     */
    protected function makeItem($iElementID)
    {
        return SerieItem::make($iElementID);
    }
}
