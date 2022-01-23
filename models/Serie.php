<?php

namespace Allekslar\Series\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\NameField;
use Kharanenka\Scope\SlugField;
use Kharanenka\Scope\CodeField;
use Kharanenka\Scope\ExternalIDField;
use October\Rain\Database\Traits\NestedTree;
use Lovata\Toolbox\Traits\Helpers\TraitCached;
use Lovata\GoodNews\Models\Article;
use Allekslar\Series\Classes\Store\SerieListStore;

/**
 * Class Serie
 * @package Allekslar\Series\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
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
 * @property Serie $parent
 * @property \October\Rain\Database\Collection|Serie[] $children
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 *
 * @method static $this children()
 * @method static $this getByParentID(int $iParentID)
 */
class Serie extends Model
{
    use Sluggable;
    use Validation;
    use ActiveField;
    use NameField;
    use SlugField;
    use CodeField;
    use ExternalIDField;
    use NestedTree;
    use TraitCached;

    /** @var string */
    public $table = 'allekslar_series_series';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [
        'name',
    ];
    /** @var array */
    public $attributeNames = [
        'name' => 'lovata.toolbox::lang.field.name',
        'slug' => 'lovata.toolbox::lang.field.slug',
    ];
    /** @var array */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|unique:allekslar_series_series',
    ];
    /** @var array */
    public $slugs = [
        'slug' => 'name'
    ];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'active',
        'name',
        'slug',
        'code',
        'external_id',

    ];
    /** @var array */
    public $cached = [
        'id',
        'parent_id',
        'active',
        'name',
        'slug',
        'code',
        'external_id',
        'view_count',

    ];
    /** @var array */
    public $dates = [
        'created_at',
        'updated_at',
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = [];
    /** @var array */
    public $hasOne = [];
    /** @var array */
    public $hasMany = ['article' => Article::class];
    /** @var array */
    public $belongsTo = [];
    /** @var array */
    public $belongsToMany = [];
    /** @var array */
    public $morphTo = [];
    /** @var array */
    public $morphOne = [];
    /** @var array */
    public $morphMany = [];
    /** @var array */
    public $attachOne = [];
    /** @var array */
    public $attachMany = [];

    /**
     * Get by parent ID
     * @param Serie $obQuery
     * @param string   $sData
     * @return Serie
     */

    public static function listAllSeries()
    {
        return Serie::lists('name', 'id');
    }
    public function scopeGetByParentID($obQuery, $sData)
    {
        return $obQuery->where('parent_id', $sData);
    }
}
