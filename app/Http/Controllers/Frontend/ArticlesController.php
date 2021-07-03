<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleCategory;

/**
 * Class ArticlesController.
 */
class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::where(['status'=> 1])->get();
        $categories = ArticleCategory::all();
        return view('frontend.articles.articles' , compact(['articles','categories']));
    }

    public function show($id)
    {
        $article = Article::where(['status'=> 1 ])->find($id);
        
        return view('frontend.articles.article' , compact('article'));
        
    }
    public function filterArticles($id){

        $articles = ArticleCategory::find($id)->articles;
        $categories = ArticleCategory::all();
        return view('frontend.articles.articles' , compact(['articles','categories']));

    }



}
