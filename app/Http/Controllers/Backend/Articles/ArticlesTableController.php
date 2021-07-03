<?php

namespace App\Http\Controllers\Backend\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Articles\ManageArticlesRequest;
use App\Repositories\Backend\ArticlesRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ArticlesTableController.
 */
class ArticlesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\ArticlesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\ArticlesRepository $repository
     */
    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Articles\ManageArticlesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageArticlesRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($articles) {
                return $articles->status;
            })
            ->addColumn('publish_datetime', function ($articles) {
                return $articles->publish_datetime->format('d/m/Y h:i A');
            })
            ->addColumn('created_by', function ($articles) {
                return $articles->user_name;
            })
            ->addColumn('created_at', function ($articles) {
                return $articles->created_at->toDateString();
            })
            ->addColumn('actions', function ($articles) {
                return $articles->action_buttons;
            })
            ->make(true);
    }
}
