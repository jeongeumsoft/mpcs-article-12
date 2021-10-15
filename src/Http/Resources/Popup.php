<?php

namespace Exit11\Article\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mpcs\Core\Traits\ResourceTrait;
use Illuminate\Support\Carbon;

class Popup extends JsonResource
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
            'order' => $this->order,
            'type' => $this->type,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'image_file_url' => $this->image_file_url,
            'background_color' => $this->background_color,
            'url' => $this->url,
            'target' => $this->target,
            'is_visible' => $this->is_visible,
            'status_released' => $this->status_released ?
                trans("mpcs-article::word.attr.released")
                : trans("mpcs-article::word.attr.nonrelease"),
            'period_from' => Carbon::parse($this->period_from)->format('Y-m-d H:i:s'),
            'period_to' => Carbon::parse($this->period_to)->format('Y-m-d H:i:s'),
            'user' => $this->whenLoaded('user', function () {
                return $this->user;
            }),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'deleted_at' => Carbon::parse($this->deleted_at)->format('Y-m-d H:i:s'),
        ];
    }
}
