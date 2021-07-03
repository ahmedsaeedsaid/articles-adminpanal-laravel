<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">

    

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@lang('labels.backend.access.article-category.table.category') </a>

                       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
                            @foreach($categories as $category)
                                
                                    <small><a href="{{ route('frontend.articles.filter',$category->id) }}" class="dropdown-item pt-1 pb-1">{{ $category->name }}</a></small>
                                
                            @endforeach
                        </div>
                        
                </li>
            

        </ul>
    </div>
</nav>
