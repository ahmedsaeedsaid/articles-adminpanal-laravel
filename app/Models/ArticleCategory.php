<?php

namespace App\Models;

use App\Models\Traits\Attributes\ArticleCategoryAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\ArticleCategoryRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends BaseModel
{
    use ModelAttributes, SoftDeletes, ArticleCategoryAttributes, ArticleCategoryRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
