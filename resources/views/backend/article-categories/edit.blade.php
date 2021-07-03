@extends('backend.layouts.app')

@section('title', __('labels.backend.access.article-category.management') . ' | ' . __('labels.backend.access.article-category.edit'))

@section('breadcrumb-links')
    @include('backend.article-categories.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($articleCategory, ['route' => ['admin.article-categories.update', $articleCategory], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        @include('backend.article-categories.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.article-categories.index', 'id' => $articleCategory->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection