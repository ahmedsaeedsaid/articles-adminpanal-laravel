@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <i class="fab fa-font-awesome-flag "> {{ $article->name }} </i> 
                        </div>
                        <div class="card-body">
                            {{ $article->meta_description }}
                            @include('frontend.articles.includes.comments')

                            
                            @include('frontend.articles.includes.add_comment') 
                            
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-->
            </div><!--row-->    
@endsection