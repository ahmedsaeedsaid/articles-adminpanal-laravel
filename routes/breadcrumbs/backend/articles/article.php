<?php

Breadcrumbs::for('admin.articles.index', function ($trail) {
    $trail->push(__('labels.backend.access.articles.management'), route('admin.articles.index'));
});

Breadcrumbs::for('admin.articles.create', function ($trail) {
    $trail->parent('admin.articles.index');
    $trail->push(__('labels.backend.access.articles.management'), route('admin.articles.create'));
});

Breadcrumbs::for('admin.articles.edit', function ($trail, $id) {
    $trail->parent('admin.articles.index');
    $trail->push(__('labels.backend.access.articles.management'), route('admin.articles.edit', $id));
});
