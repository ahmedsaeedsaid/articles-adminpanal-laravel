@extends('backend.layouts.app')

@section('title', __('labels.backend.access.articles.management') . ' | ' . __('labels.backend.access.articles.edit'))

@section('breadcrumb-links')
    @include('backend.articles.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::model($article, ['route' => ['admin.articles.update', $article], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}

    <div class="card">
        @include('backend.articles.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.articles.index', 'id' => $article->id ])
    </div><!--card-->
    {{ Form::close() }}
@endsection