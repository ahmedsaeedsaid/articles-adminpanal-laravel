<?php

namespace App\Models;

use App\Models\Traits\Attributes\ArticleCommentAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\ArticleCommentRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleComment extends BaseModel
{
    use ModelAttributes, SoftDeletes, ArticleCommentAttributes, ArticleCommentRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'meta_comment',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Casts.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = [
        'display_status',
    ];
}
