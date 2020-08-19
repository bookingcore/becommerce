<div id="search-2" class="widget widget_search">
    <form role="search" method="get" class="search-form" action="{{ url(app_get_locale(false,false,'/').config('news.news_route_prefix')) }}">
        <label>
            <span class="screen-reader-text">Search for:</span>
            <input type="search" class="search-field" placeholder="{{__("Search ...")}}" value="{{ strip_tags(Request::query("s")) }}" name="s">
        </label>
        <input type="submit" class="search-submit" value="Search">
    </form>
</div>
