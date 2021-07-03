<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Http\Requests\frontend\ArticleComments\CreateArticleCommentRequest;

/**
 * Class ArticlesController.
 */
class CommentController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function store(CreateArticleCommentRequest $request)
    {
        $article = Article::find($request->get('article_id'));
        $comment = new ArticleComment;
        $comment->name = $request->get('name');
        $comment->meta_comment = $request->get('comment');
        $article->comments()->save($comment);
        return redirect()->back();
    }



}
