<?php namespace Allekslar\Series\Controllers;

use Event;
use BackendMenu;
use Backend\Classes\Controller;
use Allekslar\Series\Classes\Event\Serie\SerieModelHandler;

/**
 * Class Series
 * @package Allekslar\Series\Controllers
 */
class Series extends Controller
{
    /** @var array */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.FormController',
    ];
    /** @var string */
    public $listConfig = 'config_list.yaml';
    /** @var string */
    public $reorderConfig = 'config_reorder.yaml';
    /** @var string */
    public $formConfig = 'config_form.yaml';

    /**
     * Series constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Allekslar.Series', 'series-menu-main', 'series-menu-series');
    }

    /**
     * Ajax handler onReorder event
     */
    public function onReorder()
    {
        $obResult = parent::onReorder();
        Event::fire(SerieModelHandler::EVENT_UPDATE_SORTING);

        return $obResult;
    }
}
