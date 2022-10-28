<?php

namespace Mpcs\Article\Http\Resources;

use Mpcs\Core\Facades\Core;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;

class ArticleFile extends JsonResource
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
            'article_id' => $this->article_id,
            'original_name' => $this->original_name,
            'name' => $this->name,
            'caption' => $this->caption,
            'mime' => $this->mime,
            'size' => $this->size,
            'download_count' => $this->download_count,
            'download_url' => route(Core::getRouteName('article_files.download'), ['article_file' => $this->id]),
            'file_url' => $this->file_url,
            'article' => $this->whenLoaded('article', function () {
                return new ArticleCollection($this->article);
            }),
            'is_image_type' => $this->is_image_type,
            'image_file_url' => $this->image_file_url,
            'thumb_image_url' => $this->thumb_image_url,
            'small_image_url' => $this->small_image_url,
            'medium_image_url' => $this->medium_image_url,
            'image_aspect_ratio' => $this->image_aspect_ratio,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
