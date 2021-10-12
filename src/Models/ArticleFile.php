<?php

namespace Exit11\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Mpcs\Core\Traits\ModelTrait;
use Illuminate\Support\Facades\Storage;
use MpcsUi\Bootstrap5\Facades\Bootstrap5;

class ArticleFile extends Model
{
    use ModelTrait;

    protected $table = 'article_files';
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected static $m_params = [
        'default_load_relations' => [],
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    private $uploadDisk;
    private $rootDir;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->uploadDisk = Storage::disk('upload');
        $this->rootDir = 'article_files';
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
     * article
     *
     * @return void
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function getSizeAttribute($value)
    {
        return Bootstrap5::formatSizeUnits($value);
    }

    /**
     * getDownloadCountAttribute
     *
     * @return void
     */
    public function getDownloadCountAttribute()
    {
        return number_format($this->attributes['download_count'] ?? 0);
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
    public function getRootDirAttribute()
    {
        return $this->rootDir;
    }

    /**
     * getDirPathAttribute
     *
     * @return void
     */
    public function getDirPathAttribute()
    {
        return $this->root_dir;
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getFileUrlAttribute()
    {
        return $this->upload_disk->url($this->dir_path . "/" . $this->name);
    }

    /**
     * getFilePathAttribute
     *
     * @return void
     */
    public function getFilePathAttribute()
    {
        return $this->dir_path . DIRECTORY_SEPARATOR . $this->name;
    }

    /**
     * getFileFullPathAttribute
     *
     * @return void
     */
    public function getFileFullPathAttribute()
    {
        return $this->upload_disk->path($this->file_path);
    }
}
