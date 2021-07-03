<?php

namespace App\Http\Requests\Backend\ArticleCategories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateArticleCategoriesRequest.
 */
class UpdateArticleCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-article-category');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191', 'unique:article_categories,name,'.optional($this->route('article_category'))->id],
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
            'name.unique' => 'Article category name already exists, please enter a different name.',
            'name.required' => 'Please insert Article Title',
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
