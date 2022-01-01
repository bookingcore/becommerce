<aside class="widget widget--blog widget--search">
    <form class="ps-form--widget-search" action="{{route('news')}}" method="get">
        <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__('Search...')}}">
        <button><i class="icon-magnifier"></i></button>
    </form>
</aside>
@include('news.sidebar.category')
@include('news.sidebar.recent-posts')
@include('news.sidebar.tags')
