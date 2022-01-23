<?php namespace Allekslar\Series\Classes\Item;

use Cms\Classes\Page as CmsPage;
use Cms;
use October\Rain\Router\Helper;

use Lovata\Toolbox\Classes\Item\ElementItem;
use Lovata\Toolbox\Classes\Helper\PageHelper;

use Allekslar\Series\Classes\Collection\SerieCollection;
use Allekslar\Series\Models\Serie;

/**
 * Class SerieItem
 * @package Allekslar\Series\Classes\Item
 *
 * @property integer $id
 * @property bool $active
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property string $external_id
 * @property string $description
 * @property int $view_count
 * @property int $parent_id
 * @property int $nest_left
 * @property int $nest_right
 * @property int $nest_depth
 * @property array $children_id_list
 * @property Serie $parent
 * @property \October\Rain\Database\Collection|Serie[] $children
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class SerieItem extends ElementItem
{
    const MODEL_CLASS = Serie::class;

    /** @var Serie */
    protected $obElement = null;
    /** @var array */
    public $arRelationList = [
        'parent'   => [
            'class' => SerieItem::class,
            'field' => 'parent_id',
        ],
        'children' => [
            'class' => SerieCollection::class,
            'field' => 'children_id_list',
        ],
    ];

    /**
     * Returns URL of a brand page.
     * @param string $sPageCode
     * @return string
     */
    public function getPageUrl($sPageCode = 'serie')
    {
        //Get URL params
        $arParamList = $this->getPageParamList($sPageCode);

        //Generate page URL
        $sURL = CmsPage::url($sPageCode, $arParamList);

        return $sURL;
    }

    /**
     * Get URL param list by page code
     * @param string $sPageCode
     * @return array
     */
    public function getPageParamList($sPageCode) : array
    {
        $arPageParamList = [];

        //Get URL params for page
        $arParamList = PageHelper::instance()->getUrlParamList($sPageCode, 'SeriePage');
        if (!empty($arParamList)) {
            $sPageParam = array_shift($arParamList);
            $arPageParamList[$sPageParam] = $this->slug;
        }

        return $arPageParamList;
    }

    /**
     * Set element data from model object
     * @return array
     */
    protected function getElementData()
    {
        $arResult = [
            'nest_depth' => $this->obElement->getDepth(),
        ];

        $arResult['children_id_list'] = $this->obElement->children()
            ->active()
            ->orderBy('nest_left', 'asc')
            ->lists('id');

        return $arResult;
    }

            /**
     * Get array with series slugs
     * @return array
     */
    protected function getSlugList(): array
    {
        $arResult = [$this->slug];

        $obParentCategory = $this->parent;
        while ($obParentCategory->isNotEmpty()) {
            $arResult[] = $obParentCategory->slug;
            $obParentCategory = $obParentCategory->parent;
        }

        return $arResult;
    }

        /**
     * Build URL path add name
     *
     * @param string $sFragment
     * @return array
     */
    private function buildUrl($sFragment = '/series'): array
    {

        $arResultUrl[] = $this->slug;
        $arResultName[] = $this->name;
        $sBaseUrl = Cms::url().$sFragment;

        $obParentCategory = $this->parent;
        while ($obParentCategory->isNotEmpty()) {

            $arResultSlug[] = $obParentCategory->slug;

            $obCategoryParent = $obParentCategory->parent;
            while ($obCategoryParent->isNotEmpty()) {
                $arResultSlug[] = $obCategoryParent->slug;
                $obCategoryParent = $obCategoryParent->parent;
            }

            $sPathUrl = Helper::rebuildUrl(array_reverse($arResultSlug));
            $url =  $sBaseUrl . $sFragment . $sPathUrl;

            $arResultUrl[] = $url;
            $arResultName[] = $obParentCategory->name;
            $obParentCategory = $obParentCategory->parent;
            $arResultSlug = [];
        }

        $arResult =  array_combine($arResultUrl, $arResultName);
        return $arResult;
    }


    /**
     * Get array with page breadcrumbs
     * @param string $sFragment
     * @return array
     */
    public function getBreadcrumbs($sHome='Home' ,$sFragment = ''): array
    {
        $arResultUrl = $this->buildUrl($sFragment);
        $arResult = [];

        foreach ($arResultUrl as $key => $value) {
            $arResult[] = array('name' => $value, 'url' =>  $key);
        }
        $arResult[] = array('name' => $sHome, 'url' => Cms::url() . $sFragment);

        return array_reverse($arResult);
    }
}
