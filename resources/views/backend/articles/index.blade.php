@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.articles.management'))

@section('breadcrumb-links')
@include('backend.articles.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.articles.management') }} <small class="text-muted">{{ __('labels.backend.access.articles.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="articles-table" class="table" data-ajax_url="{{ route("admin.articles.get") }}">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.articles.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.articles.table.published') }}</th>
                                <th>{{ trans('labels.backend.access.articles.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.articles.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.articles.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->


    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Articles.list.init();
    });
</script>
@stop