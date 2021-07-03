@extends('backend.layouts.app')

@section('title', __('labels.backend.access.articles.management') . ' | ' . __('labels.backend.access.articles.create'))

@section('breadcrumb-links')
    @include('backend.articles.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.articles.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

    <div class="card">
        @include('backend.articles.form')
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.articles.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection