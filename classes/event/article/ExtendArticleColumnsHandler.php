<?php namespace Allekslar\Series\Classes\Event\Article;

use Lovata\Toolbox\Classes\Event\AbstractBackendColumnHandler;
use Lovata\GoodNews\Models\Article;
use Lovata\GoodNews\Controllers\Articles;

/**
 * Class ExtendArticleColumnsHandler
 * @package Allekslar\Series\Classes\Event\Article
 */
class ExtendArticleColumnsHandler extends AbstractBackendColumnHandler
{
    /**
     * Extend columns model
     * @param \Backend\Widgets\Lists $obWidget
     */
    protected function extendColumns($obWidget)
    {
        $this->removeColumn($obWidget);
        $this->addColumn($obWidget);
    }

    /**
     * Remove columns model
     * @param \Backend\Widgets\Lists $obWidget
     */
    protected function removeColumn($obWidget)
    {
        $obWidget->removeColumn('');
    }

    /**
     * Add columns model
     * @param \Backend\Widgets\Lists $obWidget
     */
    protected function addColumn($obWidget)
    {
        $obWidget->addColumns([
            'serie[name]' => [
                'type'      => 'text',
                'label'     => 'allekslar.series::lang.serie.name',
                'sortable'  => false,
            ],

        ]);
    }

    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass() : string
    {
        return Article::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass() : string
    {
        return Articles::class;
    }
}
