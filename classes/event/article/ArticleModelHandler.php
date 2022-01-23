<?php

namespace Allekslar\Series\Classes\Event\Article;

use Lovata\Toolbox\Classes\Event\ModelHandler;
use Lovata\GoodNews\Models\Article;

use Lovata\GoodNews\Classes\Item\ArticleItem;
use Lovata\GoodNews\Classes\Store\ArticleListStore;
use Allekslar\Series\Classes\Store\SerieListStore;

/**
 * Class ArticleModelHandler
 * @package Allekslar\Series\Classes\Event\Article
 */
class ArticleModelHandler extends ModelHandler
{
    /** @var Article */
    protected $obArticle;

    /**
     *  Add listeners
     */
    public function subscribe($obArticle)
    {
        parent::subscribe($obArticle);

        Article::extend(function ($obArticle) {

            $this->extendArticletModel($obArticle);
        });
    }

    /**
     * Extend Article model
     * @param Article $obArticle
     */
    protected function extendArticletModel($obArticle)
    {
        $obArticle->addCachedField([
            'serie_id',
        ]);
        /** @var Series $obArticle */
        $obArticle->belongsTo['serie'] = [
            'Allekslar\Series\Models\Serie',
        ];
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass()
    {
        return Article::class;
    }

    /**
     * Get item class name
     * @return string
     */
    protected function getItemClass()
    {
        return ArticleItem::class;
    }
    /**
     * After create event handler
     */
    protected function afterCreate()
    {
        parent::afterCreate();

        $this->clearBySortingPublished();
    }

    /**
     * After save event handler
     */
    protected function afterSave()
    {
        parent::afterSave();
    }

    /**
     * After delete event handler
     */
    protected function afterDelete()
    {
        parent::afterDelete();

        $this->clearBySortingPublished();
    }

    /**
     * Clear cache by created_at
     */
    protected function clearBySortingPublished()
    {
        ArticleListStore::instance()->sorting->clear(ArticleListStore::SORT_PUBLISH_ASC);
        ArticleListStore::instance()->sorting->clear(ArticleListStore::SORT_PUBLISH_DESC);
    }
}
