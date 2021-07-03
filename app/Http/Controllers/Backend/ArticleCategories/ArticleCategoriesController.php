<?php

namespace App\Http\Controllers\Backend\ArticleCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleCategories\CreateArticleCategoriesRequest;
use App\Http\Requests\Backend\ArticleCategories\DeleteArticleCategoriesRequest;
use App\Http\Requests\Backend\ArticleCategories\ManageArticleCategoriesRequest;
use App\Http\Requests\Backend\ArticleCategories\StoreArticleCategoriesRequest;
use App\Http\Requests\Backend\ArticleCategories\UpdateArticleCategoriesRequest;
use App\Http\Responses\Backend\ArticleCategory\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\ArticleCategory;
use App\Repositories\Backend\ArticleCategoriesRepository;
use Illuminate\Support\Facades\View;

class ArticleCategoriesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\ArticleCategoriesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\ArticleCategoriesRepository $repository
     */
    public function __construct(ArticleCategoriesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['article-categories']);
    }

    /**
     * @param \App\Http\Requests\Backend\ArticleCategories\ManageArticleCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageArticleCategoriesRequest $request)
    {
        return new ViewResponse('backend.article-categories.index');
    }

    /**
     * @param \App\Http\Requests\Backend\ArticleCategories\CreateArticleCategoriesRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateArticleCategoriesRequest $request)
    {
        return new ViewResponse('backend.article-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Backend\ArticleCategories\StoreArticleCategoriesRequest  $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreArticleCategoriesRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.article-categories.index'), ['flash_success' => __('alerts.backend.article-category.created')]);
    }

    /**
     * @param \App\Models\ArticleCategory $articleCategory
     * @param \App\Http\Requests\Backend\ArticleCategories\ManageArticleCategoriesRequest $request
     *
     * @return \App\Http\Responses\Backend\ArticleCategory\EditResponse
     */
    public function edit(ArticleCategory $articleCategory, ManageArticleCategoriesRequest $request)
    {
        return new EditResponse($articleCategory);
    }

    /**
     * @param \App\Models\ArticleCategory $articleCategory
     * @param \App\Http\Requests\Backend\ArticleCategories\UpdateArticleCategoriesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(ArticleCategory $articleCategory, UpdateArticleCategoriesRequest $request)
    {
        $this->repository->update($articleCategory, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.article-categories.index'), ['flash_success' => __('alerts.backend.article-category.updated')]);
    }

    /**
     * @param \App\Models\ArticleCategory $articleCategory
     * @param \App\Http\Requests\Backend\ArticleCategories\DeleteArticleCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(ArticleCategory $articleCategory, DeleteArticleCategoriesRequest $request)
    {
        $this->repository->delete($articleCategory);

        return new RedirectResponse(route('admin.article-categories.index'), ['flash_success' => __('alerts.backend.article-category.deleted')]);
    }
}
