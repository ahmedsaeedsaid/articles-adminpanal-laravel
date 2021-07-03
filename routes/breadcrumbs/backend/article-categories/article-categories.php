<?php

Breadcrumbs::for('admin.article-categories.index', function ($trail) {
    $trail->push(__('labels.backend.access.article-category.management'), route('admin.article-categories.index'));
});

Breadcrumbs::for('admin.article-categories.create', function ($trail) {
    $trail->parent('admin.article-categories.index');
    $trail->push(__('labels.backend.access.article-category.management'), route('admin.article-categories.create'));
});

Breadcrumbs::for('admin.article-categories.edit', function ($trail, $id) {
    $trail->parent('admin.article-categories.index');
    $trail->push(__('labels.backend.access.article-category.management'), route('admin.article-categories.edit', $id));
});
