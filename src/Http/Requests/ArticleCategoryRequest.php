<?php

namespace Exit11\Article\Http\Requests;

use Mpcs\Core\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
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
                'name' => 'required|max:255',
                'description' => 'max:512',
            ],
            'PUT' => [
                'name' => 'sometimes|required|max:255',
                'description' => 'max:512',
            ],
        ];

        return $rules[$this->method()] ?? [];
    }
}
