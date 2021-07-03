@extends('backend.layouts.app')

@section('title', __('labels.backend.access.article-category.management') . ' | ' . __('labels.backend.access.article-category.create'))

@section('breadcrumb-links')
    @include('backend.article-categories.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.article-categories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.article-categories.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.article-categories.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection