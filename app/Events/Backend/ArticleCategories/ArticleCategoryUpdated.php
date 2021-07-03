<?php

namespace App\Events\Backend\ArticleCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class ArticleCategoryUpdated.
 */
class ArticleCategoryUpdated
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
