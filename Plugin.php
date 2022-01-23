<?php namespace Allekslar\Series;

use Event;
use System\Classes\PluginBase;
use Allekslar\Series\Classes\Event\Serie\SerieModelHandler;
use Allekslar\Series\Classes\Event\Article\ArticleModelHandler;
use Allekslar\Series\Classes\Event\Article\ExtendArticleFieldsHandler;
use Allekslar\Series\Classes\Event\Article\ExtendArticleColumnsHandler;
use Allekslar\Series\Classes\Event\Article\ExtendArticleItem;

/**
 * Class Plugin
 * @package Allekslar\Series
 */
class Plugin extends PluginBase
{
    public $require = ['Lovata.GoodNews', 'Lovata.Toolbox'];
    /**
     * Plugin boot method
     */
    public function boot(): void
    {

        $this->addEventListener();
    }


    /**
     * Add event listeners
     */
    protected function addEventListener(): void
    {
        // Series event
        Event::subscribe(SerieModelHandler::class);
        // Article event
        Event::subscribe(ExtendArticleColumnsHandler::class);
        Event::subscribe(ExtendArticleFieldsHandler::class);
        Event::subscribe(ArticleModelHandler::class);
        Event::subscribe(ExtendArticleItem::class);

    }

    /**
     * Register component plugin method
     * @return array
     */
    public function registerComponents(): array
    {

        return [
            'Allekslar\Series\Components\SerieData'         => 'SeriesData',
            'Allekslar\Series\Components\SerieList'         => 'SeriesList',
            'Allekslar\Series\Components\SeriePage'         => 'SeriesPage',

        ];
    }
}
