<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\ArticleCategory;
use App\Models\ArticleComment;

trait ArticleRelationships
{
    /**
     * Articles has many relationship with Article categories.
     */
    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_map_categories', 'article_id', 'category_id');
    }

    /**
     * Articles has many relationship with Article comments.
     */
    public function comments()
    {
        return $this->belongsToMany(ArticleComment::class, 'article_map_comments', 'article_id', 'comment_id');
    }

    /**
     * Articles belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Articles updated by User.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
