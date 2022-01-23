<?php

namespace Allekslar\Series\Classes\Event\Article;

use Lovata\Toolbox\Classes\Event\AbstractBackendFieldHandler;
use Lovata\GoodNews\Models\Article;
use Lovata\GoodNews\Controllers\Articles;
use Allekslar\Series\Models\Serie;


/**
 * Class ExtendArticleFieldsHandler
 * @package Allekslar\Series\Classes\Event\Article
 */
class ExtendArticleFieldsHandler extends AbstractBackendFieldHandler
{
    /**
     * Extend fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function extendFields($obWidget)
    {
        $this->removeField($obWidget);
        if (false === $obWidget->isNested) {
            $this->addField($obWidget);
        }
    }

    /**
     * Add fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function addField($obWidget)
    {
        $arAdditionFields = [

            'serie' => [
                'label' => 'allekslar.series::lang.form.series.label',
                'tab' => 'Series',
                'type'  => 'relation',
                'emptyOption' => 'lovata.toolbox::lang.field.empty',
                'options'     => Serie::listAllSeries()
            ],

        ];
        $obWidget->addTabFields($arAdditionFields);
    }

    /**
     * Remove fields model
     * @param \Backend\Widgets\Form $obWidget
     */
    protected function removeField($obWidget)
    {
        $obWidget->removeField('');
    }


    /**
     * Get model class name
     * @return string
     */
    protected function getModelClass(): string
    {
        return Article::class;
    }

    /**
     * Get controller class name
     * @return string
     */
    protected function getControllerClass(): string
    {
        return Articles::class;
    }
}
