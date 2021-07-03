<?php

namespace App\Repositories\Backend;

use App\Events\Backend\ArticleCategories\ArticleCategoryCreated;
use App\Events\Backend\ArticleCategories\ArticleCategoryDeleted;
use App\Events\Backend\ArticleCategories\ArticleCategoryUpdated;
use App\Exceptions\GeneralException;
use App\Models\ArticleCategory;
use App\Repositories\BaseRepository;

class ArticleCategoriesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = ArticleCategory::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'creator',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'article_categories.created_by')
            ->select([
                'article_categories.id',
                'article_categories.name',
                'article_categories.status',
                'article_categories.created_at',
                'users.first_name as created_by',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(__('exceptions.backend.article-category.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['created_by'] = auth()->user()->id;

        if ($articlecategory = ArticleCategory::create($input)) {
            event(new ArticleCategoryCreated($articlecategory));

            return $articlecategory;
        }

        throw new GeneralException(__('exceptions.backend.article-category.create_error'));
    }

    /**
     * @param \App\Models\ArticleCategory $articlecategory
     * @param  $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(ArticleCategory $articlecategory, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $articlecategory->id)->first()) {
            throw new GeneralException(__('exceptions.backend.article-category.already_exists'));
        }

        $input['status'] = $input['status'] ?? 0;
        $input['updated_by'] = auth()->user()->id;

        if ($articlecategory->update($input)) {
            event(new ArticleCategoryUpdated($articlecategory));

            return $articlecategory->fresh();
        }

        throw new GeneralException(__('exceptions.backend.article-category.update_error'));
    }

    /**
     * @param \App\Models\ArticleCategory $articlecategory
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(ArticleCategory $articlecategory)
    {
        if ($articlecategory->delete()) {
            event(new ArticleCategoryDeleted($articlecategory));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.article-category.delete_error'));
    }
}
