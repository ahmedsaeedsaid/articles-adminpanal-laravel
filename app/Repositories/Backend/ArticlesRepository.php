<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Articles\ArticleCreated;
use App\Events\Backend\Articles\ArticleDeleted;
use App\Events\Backend\Articles\ArticleUpdated;
use App\Exceptions\GeneralException;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleMapCategory;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticlesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Article::class;

    protected $upload_path;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'article'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

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
                'owner',
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
            ->leftjoin('users', 'users.id', '=', 'articles.created_by')
            ->select([
                'articles.id',
                'articles.name',
                'articles.publish_datetime',
                'articles.status',
                'articles.created_by',
                'articles.created_at',
                'users.first_name as user_name',
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
        $categoriesArray = $this->createCategories($input['categories']);

        unset($input['categories']);

        return DB::transaction(function () use ($input, $categoriesArray) {
            $input['slug'] = Str::slug($input['name']);
            $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
            $input['created_by'] = auth()->user()->id;

            $input = $this->uploadImage($input);

            if ($article = Article::create($input)) {
                // Inserting associated category's id in mapper table
                if (count($categoriesArray)) {
                    $article->categories()->sync($categoriesArray);
                }

                

                event(new ArticleCreated($article));

                return $article;
            }

            throw new GeneralException(__('exceptions.backend.articles.create_error'));
        });
    }

    /**
     * @param \App\Models\Article $article
     * @param array $input
     */
    public function update(Article $article, array $input)
    {
        $categoriesArray = $this->createCategories($input['categories']);

        unset($input['categories']);

        $input['slug'] = Str::slug($input['name']);
        $input['updated_by'] = auth()->user()->id;
        $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);

        // Uploading Image
        if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($article);
            $input = $this->uploadImage($input);
        }

        return DB::transaction(function () use ($article, $input, $categoriesArray) {
            if ($article->update($input)) {
                // Updateing associated category's id in mapper table
                if (count($categoriesArray)) {
                    $article->categories()->sync($categoriesArray);
                }

                

                event(new ArticleUpdated($article));

                return $article->fresh();
            }

            throw new GeneralException(__('exceptions.backend.articles.update_error'));
        });
    }

    /**
     * Creating Categories.
     *
     * @param array $categories
     *
     * @return array
     */
    public function createCategories($categories)
    {
        //Creating a new array for categories (newly created)
        $categories_array = [];

        foreach ($categories as $category) {
            if (is_numeric($category)) {
                $categories_array[] = $category;
            } else {
                $newCategory = ArticleCategory::firstOrCreate(
                    [
                        'name' => $category,
                    ],
                    [
                        'name' => $category,
                        'status' => 1,
                        'created_by' => auth()->user()->id,
                    ]
                );

                $categories_array[] = $newCategory->id;
            }
        }

        return $categories_array;
    }

    /**
     * @param \App\Models\Articles\Article $article
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Article $article)
    {
        DB::transaction(function () use ($article) {
            if ($article->delete()) {
                ArticleMapCategory::where('article_id', $article->id)->delete();

                event(new ArticleDeleted($article));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.articles.delete_error'));
        });
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        if (isset($input['featured_image']) && ! empty($input['featured_image'])) {
            $avatar = $input['featured_image'];
            $fileName = time().$avatar->getClientOriginalName();

            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['featured_image' => $fileName]);
        }

        return $input;
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->featured_image;

        return $this->storage->delete($this->upload_path.$fileName);
    }
}
