<?php

namespace App\Models;

use App\Models\Traits\Attributes\ArticleAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\ArticleRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{
    use ModelAttributes, SoftDeletes, ArticleAttributes, ArticleRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'cannonical_link',
        'meta_keywords',
        'meta_description',
        'status',
        'featured_image',
        'created_by',
        'updated_by',
    ];

    /**
     * Dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at',
    ];

    /**
     * Statuses.
     *
     * @var array
     */
    protected $statuses = [
        0 => 'InActive',
        1 => 'Published',
        2 => 'Draft',
        3 => 'Scheduled',
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
