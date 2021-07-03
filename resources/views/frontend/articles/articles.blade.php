@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    @include('frontend.articles.includes.nav')
    @foreach ($articles as $article)
        <a href="{{ route('frontend.article',$article->id) }}" style="color: #000">
            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <i class="fab fa-font-awesome-flag"> {{ $article->name }} </i> 
                        </div>
                        <div class="card-body">
                            {{ $article->content }}
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </a>
    @endforeach
@endsection
