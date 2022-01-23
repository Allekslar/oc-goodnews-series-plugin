<?php namespace Allekslar\Series\Classes\Event\Article;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;
use Allekslar\Series\Classes\Item\SerieItem;
use Lovata\GoodNews\Classes\Item\ArticleItem;

/**
 * Class ExtendArticleItem
 * @package Allekslar\Series\Classes\Event\Article
 */
class ExtendArticleItem
{

    /**
     * Add listeners
     */
    public function subscribe()
    {
        $this->extendItem();

    }


    /**
     * Extend item class name
     * @param string $sClassName
     */
    protected function extendItem()
    {
        ArticleItem::extend(function ($obItem) {
            /** @var \Lovata\Toolbox\Classes\Item\ElementItem $obItem */
            $obItem->arRelationList['serie'] = [
                'class' => SerieItem::class,
                'field' => 'serie_id',
            ];
        });
    }




}