<?php

namespace App\Events\Backend\Articles;

use Illuminate\Queue\SerializesModels;

/**
 * Class ArticleUpdated.
 */
class ArticleUpdated
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
