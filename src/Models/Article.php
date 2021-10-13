<?php

namespace Exit11\Article\Models;

use Exit11\Article\Facades\Article as Facade;
use Illuminate\Database\Eloquent\Model;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ModelTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Article extends Model
{
    use SoftDeletes, Sluggable, Taggable, ModelTrait;

    protected $table = 'articles';
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'released_at'];
    protected $guarded = ['id'];
    protected static $m_params = [
        //'default_load_relations' => ['articleCategories', 'articleFiles', 'tags'],
        'default_load_relations' => ['articleCategories', 'articleFiles', 'user'],
        'column_maps' => [
            // date : {컬럼명}
            'from' => 'released_at',
            'to' => 'released_at',
        ]
    ];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    public $sortable = ['id', 'title', 'view_count', 'released_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
        'deleted_at' => 'datetime:Y-m-d H:i',
        'released_at' => 'datetime:Y-m-d H:i',
        'status_released' => 'boolean',
    ];

    private $uploadDisk;
    private $imageRootDir;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        static::setMemberParams(self::$m_params);

        $this->uploadDisk = Storage::disk('upload');
        $this->imageRootDir = 'articles';
    }


    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::setMemberParams(self::$m_params);
    }


    /**
     * articleCategories
     *
     * @return void
     */
    public function articleCategories()
    {
        return $this->morphToMany(ArticleCategory::class, 'article_categorizable');
    }

    /**
     * articleFiles
     *
     * @return void
     */
    public function articleFiles()
    {
        return $this->hasMany(ArticleFile::class, 'article_id');
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('Mpcs\Core\Models\User', 'user_id');
    }

    /**
     * getStatusReleasedAttribute
     *
     * @return void
     */
    public function getStatusReleasedAttribute()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $released = $this->attributes['released_at'];
        return ($released && $released <= $now);
    }

    /**
     * getViewCountAttribute
     *
     * @return void
     */
    public function getViewCountAttribute()
    {
        return number_format($this->attributes['view_count'] ?? 0);
    }

    /**
     * setReleasedAtAttribute
     *
     * @param  mixed $date
     * @return void
     */
    public function setReleasedAtAttribute($date)
    {
        $this->attributes['released_at'] = empty($date) ? null : Carbon::parse($date);
    }

    /**
     * scopeReleased
     *
     * @param  mixed $query
     * @return void
     */
    public function scopeReleased($query)
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        return $query->where('released_at', '<=', $now);
    }

    /**
     * getUploadDiskAttribute
     *
     * @return void
     */
    public function getUploadDiskAttribute()
    {
        return $this->uploadDisk;
    }

    /**
     * getRootDirAttribute
     *
     * @return void
     */
    public function getImageRootDirAttribute()
    {
        return $this->imageRootDir;
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getImageFileUrlAttribute()
    {
        if ($this->thumbnail) {
            return $this->upload_disk->url($this->image_root_dir . '/' . $this->thumbnail);
        }
        return Facade::noImage();
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getThumbImageUrlAttribute()
    {
        if ($this->thumbnail) {
            return $this->upload_disk->url($this->image_root_dir . '/thumb_' . $this->thumbnail);
        }
        return Facade::noImage();
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getSmallImageUrlAttribute()
    {
        if ($this->thumbnail) {
            return $this->upload_disk->url($this->image_root_dir . '/small_' . $this->thumbnail);
        }
        return Facade::noImage();
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getMediumImageUrlAttribute()
    {
        if ($this->thumbnail) {
            return $this->upload_disk->url($this->image_root_dir . '/medium_' . $this->thumbnail);
        }
        return Facade::noImage();
    }

    /**
     * getImageAspectRatioAttribute
     *
     * @return void
     */
    public function getImageAspectRatioAttribute()
    {
        if ($this->thumbnail) {
            $image = $this->upload_disk->get($this->image_root_dir . '/' . $this->thumbnail);
            if ($image) {
                $width = Image::make($image)->width();
                $height = Image::make($image)->height();
                $aspectRatio = ($height / $width) * 100;
                return $aspectRatio;
            }
        }
        return 0;
    }

    /**
     * sluggable
     *
     * @return void
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source'     => 'title',
                'method' => function ($string, $separator) {
                    return preg_replace('/[^0-9a-zA-Z가-힣ㄱ-ㅎㅏ]+/i', $separator, $string);
                },
                'onUpdate'  => true
            ]
        ];
    }

    /**
     * getArticleCategoryIdsAttribute
     *
     * @return void
     */
    public function getArticleCategoryIdsAttribute()
    {
        return $this->relationLoaded('articleCategories') ? $this->articleCategories->pluck('id')->toArray() : null;
    }
}
