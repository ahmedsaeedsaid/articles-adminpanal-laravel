<?php

namespace App\Http\Requests\Backend\ArticleCategories;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageArticleCategoriesRequest.
 */
class ManageArticleCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('view-article-category');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
