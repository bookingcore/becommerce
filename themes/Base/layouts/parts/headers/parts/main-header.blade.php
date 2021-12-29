<div class="bravo-main-header">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-4 col-logo">
            <a href="{{url(app_get_locale(false,'/'))}}" class="bravo-logo">
                @if($logo_id = setting_item("logo_id"))
                    <?php $logo = get_file_url($logo_id,'full') ?>
                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                @endif
            </a>
        </div>
        <div class="col-md-9 col-sm-8 col-xs-8 col-search-user">
            @include('layouts.parts.headers.parts.searchbox')
           {{-- @include('layouts.parts.headers.parts.userbox')--}}
        </div>
    </div>
</div>
