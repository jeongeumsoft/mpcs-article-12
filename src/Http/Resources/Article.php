<?php

namespace Exit11\Article\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ResourceTrait;

class Article extends JsonResource
{
    use ResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'image_file_url' => $this->image_file_url,
            'thumb_image_url' => $this->thumb_image_url,
            'small_image_url' => $this->small_image_url,
            'medium_image_url' => $this->medium_image_url,
            'image_aspect_ratio' => $this->image_aspect_ratio,
            'view_count' => $this->view_count,
            'article_categories[]' => $this->whenLoaded('articleCategories', function () {
                return $this->categories->pluck('id')->toArray();
            }),
            'article_categories_name' => $this->whenLoaded('articleCategories', function () {
                return $this->categories->pluck('name')->toArray();
            }),
            'article_categories_slug' => $this->whenLoaded('articleCategories', function () {
                return $this->categories->pluck('slug')->toArray();
            }),
            'tags[]' => $this->whenLoaded('tags', function () {
                return $this->tagArray;
            }),
            'article_files[]' => $this->whenLoaded('articleFiles', function () {
                return $this->articleFiles;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'released_at' => $this->released_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
