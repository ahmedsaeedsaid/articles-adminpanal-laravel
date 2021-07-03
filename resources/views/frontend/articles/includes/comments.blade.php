<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
    
        <!-- Fluid width widget -->        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-comment"></span> 
                    <strong>
                        @lang('labels.frontend.article.comment')
                    </strong>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    @foreach ($article->comments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" class="img-circle">
                            </div>
                            <div class="media-body p-3">
                                <h4 class="media-heading">
                                    {{ $comment->name }}
                                    <br>
                                </h4>
                                <p>
                                    {{ $comment->meta_comment }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- End fluid width widget --> 
        
        </div>
    </div>
</div>