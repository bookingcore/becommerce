@if(!empty($list_items))
    <div class="bc-promotions pb-5">
        <div class="container">
            <div class="mb-4">
                <h3 class="fs-24 mb-1">{{ $title }}</h3>
                <span class="fs-16">{{ $sub_title }}</span>
            </div>
            <div class="row">
                @foreach($list_items as $item)
                    @php switch ($col){
                            case '4': $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            case '3': $colClass = "col-xl-$col col-lg-$col col-md-6 col-sm-12 col-12 mb-lg-0 mb-4"; break;
                            default: $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4";
                        }
                    @endphp
                    <div class="{{ $colClass }} mb-xl-0 mb-4">
                        <a class="bc-collection" href="{{ $item['link'] ?? '' }}">
                            <img  class="img-fluid w-100" src="{{ get_file_url($item['image'] ?? '' , "full") }}" alt="{{ $item['title'] ?? '' }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

