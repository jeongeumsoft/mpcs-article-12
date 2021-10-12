<?php

namespace Exit11\Article\Http\Requests;

use Illuminate\Validation\Rule;
use Mpcs\Core\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArticleFileRequest extends FormRequest
{
    use RequestTrait;

    public function rules()
    {
        $rules = $this->getRequestRules();
        if ($rules != null) {
            return $rules;
        }

        $rules = [];

        return $rules[$this->method()] ?? [];
    }
}
