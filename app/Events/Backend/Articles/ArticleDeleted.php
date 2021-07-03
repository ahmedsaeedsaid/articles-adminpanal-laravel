<?php

namespace App\Events\Backend\Articles;

use Illuminate\Queue\SerializesModels;

/**
 * Class ArticleDeleted.
 */
class ArticleDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $articles;

    /**
     * @param $articles
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }
}
