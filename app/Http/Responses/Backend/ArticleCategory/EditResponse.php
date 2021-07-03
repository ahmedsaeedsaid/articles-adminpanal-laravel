<?php

namespace App\Http\Responses\Backend\ArticleCategory;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\ArticleCategories\ArticleCategory
     */
    protected $articleCategory;

    /**
     * @param \App\Models\ArticleCategories\ArticleCategory $articleCategory
     */
    public function __construct($articleCategory)
    {
        $this->articleCategory = $articleCategory;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.article-categories.edit')
            ->with('articleCategory', $this->articleCategory);
    }
}
