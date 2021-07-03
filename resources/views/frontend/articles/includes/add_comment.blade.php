<div class="card">
    <div class="card-header">
        <strong>
            @lang('labels.frontend.article.add_comment')
        </strong>
    </div><!--card-header-->

    

    <div class="card-body">
        {{ html()->form('POST', route('frontend.articles.comment.store',$article->id))->open() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}" />
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

                        {{ html()->text('name', optional(auth()->user())->name)
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.name'))
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {{ html()->label(__('validation.attributes.frontend.comment'))->for('comment') }}

                        {{ html()->textarea('comment')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.frontend.comment'))
                            ->attribute('rows', 3)
                            ->required() }}
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            

            <div class="row">
                <div class="col">
                    <div class="form-group mb-0 clearfix">
                        {{ form_submit(__('labels.frontend.article.add_comment')) }}
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        {{ html()->form()->close() }}
    </div><!--card-body-->
</div><!--card-->