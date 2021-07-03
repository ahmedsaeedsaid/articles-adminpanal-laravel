<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\Article;

trait ArticleCategoryRelationships
{
    /**
     * ArticleCategories belongs to relationship with user.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * ArticleCategories belongs to relationship with user.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * ArticleCategories belongs to relationship with Article.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_map_categories', 'category_id', 'article_id');
    }
}
