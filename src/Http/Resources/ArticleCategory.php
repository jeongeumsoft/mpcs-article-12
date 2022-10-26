<?php

namespace Mpcs\Article\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;

class ArticleCategory extends JsonResource
{
    use ResourceTrait;

    public $params;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $params = null)
    {
        parent::__construct($resource);
        $this->params = $params;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request, $params = null)
    {
        if (!$params || !is_array($params)) {
            $params = $this->params;
        }
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'order' => $this->order,
            'type' => $this->type,
            'type_str' => $this->type_str,
            'page_style' => $this->page_style,
            'per_page' => $this->per_page,
            'is_visible' => $this->is_visible,
            'depth' => $this->depth,
            'articles' => $this->whenLoaded('articles', function () {
                return new ArticleCollection($this->articles);
            }),
            'all_children' => $this->whenLoaded('allChildren', function () use ($params) {
                return new ArticleCategoryCollection($this->allChildren, $params);
            }),
            'children' => $this->whenLoaded('children', function () use ($params) {
                return new ArticleCategoryCollection($this->children, $params);
            }),
            'nested_str' => $this->nested_str,
        ];
    }
}
