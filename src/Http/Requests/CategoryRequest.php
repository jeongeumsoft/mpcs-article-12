<?php

namespace Exit11\Article\Http\Requests;

use Illuminate\Validation\Rule;
use Mpcs\Core\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    use RequestTrait;

    public function rules()
    {
        $rules = $this->getRequestRules();
        if ($rules != null) {
            return $rules;
        }

        $id = $this->entity_category->id ?? "";
        $parentId = request()->parent_id ?? $this->parante_id;

        $rules = [
            'POST' => [
                'name' => [
                    'required',
                    'regex:/^[A-Za-z0-9-_]*$/',
                    'max:100',
                    Rule::unique('categories')->where(function ($query) use ($parentId) {
                        return $query->where('parent_id', $parentId);
                    })
                ],
                'slug' => [
                    'required',
                    'regex:/^[A-Za-z0-9-_]*$/',
                    'max:100',
                    Rule::unique('categories')->where(function ($query) use ($parentId) {
                        return $query->where('parent_id', $parentId);
                    })
                ],
                'description' => 'max:512',
            ],
            'PUT' => [
                'name' => [
                    'required',
                    'regex:/^[A-Za-z0-9-_]*$/',
                    'max:100',
                    Rule::unique('categories')->where(function ($query) use ($parentId, $id) {
                        return $query->where('parent_id', $parentId)->where('id', '<>', $id);
                    })
                ],
                'slug' => [
                    'required',
                    'regex:/^[A-Za-z0-9-_]*$/',
                    'max:100',
                    Rule::unique('categories')->where(function ($query) use ($parentId, $id) {
                        return $query->where('parent_id', $parentId)->where('id', '<>', $id);
                    })
                ],
                'description' => 'max:512',
            ],
        ];

        return $rules[$this->method()] ?? [];
    }
}
