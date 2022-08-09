<?php

namespace Mpcs\Article\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;
use Illuminate\Support\Carbon;

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
            'html' => $this->html,
            'thumbnail' => $this->thumbnail,
            'image_file_url' => $this->image_file_url,
            'thumb_image_url' => $this->thumb_image_url,
            'small_image_url' => $this->small_image_url,
            'medium_image_url' => $this->medium_image_url,
            'image_aspect_ratio' => $this->image_aspect_ratio,
            'status_released' => $this->status_released,
            'view_count' => number_format($this->view_count),
            'user' => $this->whenLoaded('user', function () {
                return $this->user;
            }),
            'article_categories' => $this->whenLoaded('articleCategories', function () {
                return new ArticleCategoryCollection($this->articleCategories);
            }),
            'article_category_ids' => $this->whenLoaded('articleCategories', function () {
                return $this->article_category_ids;
            }),
            'tags' => $this->whenLoaded('tags', function () {
                return $this->tags;
            }),
            'tag_list' => $this->whenLoaded('tags', function () {
                return $this->tagList;
            }),
            'article_files' => $this->whenLoaded('articleFiles', function () {
                return new ArticleFileCollection($this->articleFiles);
            }),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'released_at' => Carbon::parse($this->released_at)->format('Y-m-d H:i:s'),
            'deleted_at' => Carbon::parse($this->deleted_at)->format('Y-m-d H:i:s'),
        ];
    }
}
