<?php

namespace App\Events\Backend\ArticleCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class ArticleCategoryDeleted.
 */
class ArticleCategoryDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $articlecategory;

    /**
     * @param $articlecategory
     */
    public function __construct($articlecategory)
    {
        $this->articlecategory = $articlecategory;
    }
}
