<?php

namespace App\Http\Controllers\Backend\ArticleCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleCategories\ManageArticleCategoriesRequest;
use App\Repositories\Backend\ArticleCategoriesRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ArticleCategoriesTableController.
 */
class ArticleCategoriesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\ArticleCategoriesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\ArticleCategories\ArticleCategoriesRepository $repository
     */
    public function __construct(ArticleCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\ArticleCategories\ManageArticleCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageArticleCategoriesRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->filterColumn('status', function ($query, $keyword) {
                if (in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('article_categories.status', (strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereRaw('users.first_name like ?', ["%{$keyword}%"]);
            })
            ->editColumn('status', function ($articlecategory) {
                return $articlecategory->status_label;
            })
            ->editColumn('created_at', function ($articlecategory) {
                return $articlecategory->created_at->toDateString();
            })
            ->addColumn('actions', function ($articlecategory) {
                return $articlecategory->action_buttons;
            })
            ->escapeColumns(['name'])
            ->make(true);
    }
}
