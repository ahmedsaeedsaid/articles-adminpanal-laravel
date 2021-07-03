<?php

namespace App\Http\Requests\Backend\Articles;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateArticlesRequest.
 */
class UpdateArticlesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('edit-article');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191', 'unique:articles,name,'.optional($this->route('article'))->id],
            'publish_datetime' => ['required', 'date'],
            'content' => ['required', 'string'],
            'categories' => ['required', 'array'],
            'categories.*' => ['string'],
            'status' => ['integer', 'between:0,3'],
            'meta_title' => ['string', 'nullable'],
            'cannonical_link' => ['string', 'nullable', 'url'],
            'meta_keywords' => ['string', 'nullable'],
            'meta_description' => ['string', 'nullable'],
            'featured_image' => ['nullable', 'image'],
        ];
    }

    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'Article name already exists, please enter a different name.',
            'name.required' => 'Please insert Article Title',
            'name.max' => 'Article Title may not be greater than 191 characters.',
        ];
    }
}
