<?php

namespace Mpcs\Article\Models;

use Mpcs\Core\Facades\Core;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpcs\Core\Traits\ModelTrait;
use Mpcs\Bootstrap5\Traits\NestedSortableTrait;
use Mpcs\Article\CustomCollection;
use Cviebrock\EloquentSluggable\Sluggable;

use Mpcs\Article\Facades\Article as Facade;

class ArticleCategory extends Model
{
    use SoftDeletes, Sluggable, ModelTrait, NestedSortableTrait;

    protected $table = 'article_categories';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    public $sortable = ['id', 'name', 'is_visible'];
    public $defaultSortable = [
        'order' => 'asc',
    ];

    public $appends = ['nested_str', 'type_str'];

    protected static $m_params = [
        'default_load_relations' => ['allParent', 'allChildren']
    ];

    // 카테고리 깊이
    public static $maxDepth;

    public static $typeStrings = [
        1 => 'list',
        2 => 'zine',
        3 => 'thumbnail',
        4 => 'blog',
    ];

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::setMemberParams(self::$m_params);

        self::$maxDepth = Facade::getCategoryMaxDepth();
    }

    /**
     * articles
     *
     * @return void
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }


    /**
     * newCollection
     *
     * @param  mixed $models
     * @return void
     */
    public function newCollection(array $models = [])
    {
        return new CustomCollection($models);
    }

    /**
     * setNestedInfoAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setNestedInfoAttribute($parent)
    {
        $depth = 1;
        // $nestedIdx = $this->id;
        if ($parent) {
            $depth += $parent->depth;
            // $nestedIdx = $parent->nested_ids . '-' . $nestedIdx;
        }

        $this->attributes['depth'] = $depth;
        // $this->attributes['nested_ids'] = $nestedIdx;
    }

    /**
     * getAllowTypes
     *
     * @return void
     */
    public static function getAllowTypes()
    {
        return collect(static::$typeStrings);
    }

    public function getTypeStrAttribute()
    {
        return static::$typeStrings[$this->attributes['type']];
    }

    /**
     * sluggable
     *
     * @return void
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'     => 'name',
                'method' => function ($string, $separator) {
                    return preg_replace('/[^0-9a-zA-Z가-힣ㄱ-ㅎㅏ]+/i', $separator, $string);
                },
                'onUpdate'  => true
            ]
        ];
    }
}
