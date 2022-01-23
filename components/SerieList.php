<?php namespace Allekslar\Series\Components;

use Cms\Classes\ComponentBase;
use Allekslar\Series\Classes\Collection\SerieCollection;

/**
 * Class SerieList
 * @package Allekslar\Series\Components
 */
class SerieList extends ComponentBase
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'allekslar.series::lang.component.serie_list_name',
            'description' => 'allekslar.series::lang.component.serie_list_description',
        ];
    }

    /**
     * Make element collection
     * @param array $arElementIDList
     * @return SerieCollection
     */
    public function make($arElementIDList = null)
    {
        return SerieCollection::make($arElementIDList);
    }

    /**
     * Method for ajax request with empty response
     * @return bool
     */
    public function onAjaxRequest()
    {
        return true;
    }
}
