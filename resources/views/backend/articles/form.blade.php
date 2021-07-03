<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.articles.management') }}
                <small class="text-muted">{{ (isset($article)) ? __('labels.backend.access.articles.edit') : __('labels.backend.access.articles.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('name', trans('validation.attributes.backend.access.articles.title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.title'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('categories', trans('validation.attributes.backend.access.articles.article_categories'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('categories[]', $articleCategories, null, ['class' => 'form-control categories box-size', 'data-placeholder' => trans('validation.attributes.backend.access.articles.article_categories'), 'required' => 'required', 'multiple' => 'multiple']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('publish_datetime', trans('validation.attributes.backend.access.articles.publish_date_time'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    @if(!empty($article->publish_datetime))
                    {{ Form::text('publish_datetime', \Carbon\Carbon::parse($article->publish_datetime)->format('m/d/Y h:i a'), ['class' => 'form-control publish_datetime box-size', 'placeholder' => trans('validation.attributes.backend.access.articles.publish_date_time'), 'required' => 'required', 'id' => 'publish_datetime']) }}
                    @else
                    {{ Form::text('publish_datetime', null, ['class' => 'form-control publish_datetime box-size', 'placeholder' => trans('validation.attributes.backend.access.articles.publish_date_time'), 'required' => 'required', 'id' => 'publish_datetime']) }}
                    @endif
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('featured_image', trans('validation.attributes.backend.access.articles.featured_image'), ['class' => 'col-md-2 from-control-label required']) }}

                @if(!empty($article->featured_image))
                <div class="col-lg-1">
                    <img src="{{ asset('storage/img/article/'.$article->featured_image) }}" height="80" width="80">
                </div>
                <div class="col-lg-5">
                    {{ Form::file('featured_image', ['id' => 'featured_image']) }}
                </div>
                @else
                <div class="col-lg-5">
                    {{ Form::file('featured_image', ['id' => 'featured_image']) }}
                </div>
                @endif
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('content', trans('validation.attributes.backend.access.articles.content'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.content')]) }}
                </div>
                <!--col-->
            </div>
            
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_title', trans('validation.attributes.backend.access.articles.meta_title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.meta_title')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('slug', trans('validation.attributes.backend.access.articles.slug'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.slug'), 'disabled' => 'disabled']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('cannonical_link', trans('validation.attributes.backend.access.articles.cannonical_link'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('cannonical_link', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.cannonical_link')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_keywords', trans('validation.attributes.backend.access.articles.meta_keywords'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.meta_keywords')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_description', trans('validation.attributes.backend.access.articles.meta_description'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.articles.meta_description')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.articles.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('status', $status, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.articles.status'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('pagescript')
<script type="text/javascript">
    FTX.Utils.documentReady(function() {
        FTX.Articles.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
    });
</script>
@stop