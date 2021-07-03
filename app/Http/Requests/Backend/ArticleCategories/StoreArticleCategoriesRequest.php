<?php

namespace App\Http\Requests\Backend\ArticleCategories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreArticleCategoriesRequest.
 */
class StoreArticleCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-article-category');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191', 'unique:article_categories,name'],
            'status' => ['boolean'],
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Article category name must required',
            'name.unique' => 'Article category name already exist.',
            'name.max' => 'Article category may not be greater than 191 characters.',
        ];
    }

    /**
     * Body Parameters : Used by scribe to generate doc.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Name of the category.',
                'example' => 'Software',
            ],
            'status' => [
                'description' => 'Status of the category.',
                'example' => 1,
            ],
        ];
    }
}
