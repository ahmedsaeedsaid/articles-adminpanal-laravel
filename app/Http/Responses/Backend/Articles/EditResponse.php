<?php

namespace App\Http\Responses\Backend\Articles;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    protected $article;

    protected $status;

    protected $articleCategories;

    public function __construct($article, $status, $articleCategories)
    {
        $this->article = $article;
        $this->status = $status;
        $this->articleCategories = $articleCategories;
    }

    public function toResponse($request)
    {
        $selectedCategories = $this->article->categories->pluck('id')->toArray();

        return view('backend.articles.edit')->with([
            'article' => $this->article,
            'articleCategories' => $this->articleCategories,
            'selectedCategories' => $selectedCategories,
            'status' => $this->status,
        ]);
    }
}
