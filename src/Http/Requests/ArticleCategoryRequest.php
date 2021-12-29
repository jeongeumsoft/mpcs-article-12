<?php

namespace Exit11\Article\Http\Requests;

use Illuminate\Validation\Rule;
use Mpcs\Core\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
    use RequestTrait;

    public function rules()
    {
        $rules = $this->getRequestRules();
        if ($rules != null) {
            return $rules;
        }

        $id = $this->category->id ?? "";
        $parentId = request()->parent_id ?? $this->parant_id;

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
