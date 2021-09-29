<?php

namespace Exit11\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpcs\Core\Traits\ModelTrait;
use Exit11\Article\CustomCollection;
use Exit11\Article\Facades\Article;

class Category extends Model
{
    use SoftDeletes, ModelTrait;

    protected $table = 'categories';
    public $timestamps = false;
    protected $guarded = ['id'];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    public $sortable = ['id', 'name', 'is_visible'];
    public $defaultSortable = [
        'name' => 'asc',
    ];

    // 카테고리 깊이
    public static $maxDepth;

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::$maxDepth = Article::getCategoryMaxDepth();
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
}
