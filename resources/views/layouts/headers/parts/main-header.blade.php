<div class="bravo-main-header">
    <div class="row">
        <div class="col-md-3 col-logo">
            <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                @if($logo_id = setting_item("logo_id"))
                    <?php $logo = get_file_url($logo_id,'full') ?>
                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                @endif
            </a>
        </div>
        <div class="col-md-9 col-search-user">
            @include('layouts.headers.parts.searchbox')
            @include('layouts.headers.parts.userbox')
        </div>
    </div>
</div>