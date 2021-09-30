<?php

namespace Exit11\Article\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;

class ArticleCategory extends JsonResource
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
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'order' => $this->order,
            'type_str' => $this->type_str,
            'is_visible' => $this->is_visible,
            'depth' => $this->depth,
            'all_children' => $this->whenLoaded('allChildren', function () {
                return new EntityCategoryCollection($this->allChildren);
            }),
            'children' => $this->whenLoaded('children', function () {
                return new EntityCategoryCollection($this->children);
            }),
        ];
    }
}
