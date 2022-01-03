@if(!empty($list_items))
    <div class="ps-promotions">
        <div class="container">
            <div class="row">
                @foreach($list_items as $item)
                    <div class="col-xl-{{$col}} col-lg-{{$col}} col-md-{{$col}} col-sm-12 col-12">
                        <a class="ps-collection" href="{{ $item['link'] ?? '' }}">
                            <img src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

