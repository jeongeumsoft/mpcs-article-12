<?php

namespace Exit11\Article\Http\Requests;

use Mpcs\Core\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArticleFileRequest extends FormRequest
{
    use RequestTrait;

    public function rules($params = null)
    {
        $info = $this->getRequestInfo($params);
        if ($info->rules) {
            return $info->rules;
        }

        $rules = [];

        return $rules[$this->method()] ?? [];
    }
}
