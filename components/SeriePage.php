<?php namespace Allekslar\Series\Components;

use Lovata\Toolbox\Classes\Component\ElementPage;
use Allekslar\Series\Models\Serie;
use Allekslar\Series\Classes\Item\SerieItem;

/**
 * Class SeriePage
 * @package Allekslar\Series\Components
 */
class SeriePage extends ElementPage
{
    /**
     * Component details
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'allekslar.series::lang.component.serie_page_name',
            'description' => 'allekslar.series::lang.component.serie_page_description',
        ];
    }

    /**
     * Get element object
     * @param string $sElementSlug
     * @return Serie
     */
    protected function getElementObject($sElementSlug)
    {
        if (empty($sElementSlug)) {
            return null;
        }

        $obElement = Serie::active()->getBySlug($sElementSlug)->first();

        if(!empty($obElement)) {
            $obElement->view_count++;
            $obElement->save();
        }

        return $obElement;
    }

    /**
     * Make new element item
     * @param int $iElementID
     * @param Serie $obElement
     * @return SerieItem
     */
    protected function makeItem($iElementID, $obElement)
    {
        return SerieItem::make($iElementID, $obElement);
    }
}
