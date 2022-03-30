<?php

namespace Exit11\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mpcs\Core\Traits\RequestTrait;

class ArticleRequest extends FormRequest
{
    use RequestTrait;

    public function rules($params = null)
    {
        $info = $this->getRequestInfo($params);
        if ($info->rules) {
            return $info->rules;
        }

        $rules = [
            'POST' => [
                'released_at' => 'required',
                'title' => 'required|max:100',
            ],
            'PUT' => [
                'released_at' => 'sometimes|required',
                'title' => 'sometimes|required|max:100',
            ],
        ];

        return $rules[$this->method()] ?? [];
    }
}
