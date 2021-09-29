<?php

namespace Exit11\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Mpcs\Core\Traits\RequestTrait;

class ArticleRequest extends FormRequest
{
    use RequestTrait;

    public function rules()
    {
        $rules = $this->getRequestRules();
        if ($rules != null) {
            return $rules;
        }

        $rules = [
            'POST' => [],
            'PUT' => [],
        ];

        return $rules[$this->method()] ?? [];
    }
}
