<?php

namespace App\Http\Controllers\Backend\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Articles\ManageArticlesRequest;
use App\Http\Requests\Backend\Articles\StoreArticlesRequest;
use App\Http\Requests\Backend\Articles\UpdateArticlesRequest;
use App\Http\Responses\Backend\Articles\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Repositories\Backend\ArticlesRepository;
use Illuminate\Support\Facades\View;

class ArticlesController extends Controller
{

    /**
     * @var \App\Repositories\Backend\ArticlesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\ArticlesRepository $article
     */
    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['articles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\ManageArticlesRequest
     */
    public function index(ManageArticlesRequest $request)
    {
        return new ViewResponse('backend.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\ManageArticlesRequest
     */
    public function create(ManageArticlesRequest $request, Article $article)
    {
        $articleCategories = ArticleCategory::getSelectData();

        return new ViewResponse('backend.articles.create', ['status' => $article->statuses, 'articleCategories' => $articleCategories]);
    }

    /**
     * @param \App\Http\Requests\Backend\Articles\StoreArticlesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreArticlesRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.articles.index'), ['flash_success' => __('alerts.backend.articles.created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param \App\Models\Article $article
     * @param \App\Http\Requests\Backend\Articles\ManageArticlesRequest $request
     *
     * @return \App\Http\Responses\Backend\Articles\EditResponse
     */
    public function edit(Article $article, ManageArticlesRequest $request)
    {
        $articleCategories = ArticleCategory::getSelectData();

        return new EditResponse($article, $article->statuses, $articleCategories);
    }

    /**
     * @param \App\Models\Article $article
     * @param \App\Http\Requests\Backend\Articles\UpdateArticlesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Article $article, UpdateArticlesRequest $request)
    {
        $this->repository->update($article, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.articles.index'), ['flash_success' => __('alerts.backend.articles.updated')]);
    }

    /**
     * @param \App\Models\Article $article
     * @param \App\Http\Requests\Backend\Articles\ManageArticlesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Article $article, ManageArticlesRequest $request)
    {
        $this->repository->delete($article);

        return new RedirectResponse(route('admin.articles.index'), ['flash_success' => __('alerts.backend.articles.deleted')]);
    }
}
