<div class="container">
    <div class="bravo-list-space layout_{{$style_list}}">
        <div class="title">
            {{$title}}
        </div>
        @if($desc)
            <div class="sub-title">
                {{$desc}}
            </div>
        @endif
        <div class="list-item">
            @if($style_list === "normal")
                <div class="row">
                    @foreach($rows as $row)
                        <div class="col-lg-3 col-md-6">
                            @include('Product::frontend.layouts.search.loop-gird')
                        </div>
                    @endforeach
                </div>
            @endif
            @if($style_list === "carousel")
                <div class="owl-carousel">
                    @foreach($rows as $row)
                        @include('Product::frontend.layouts.search.loop-gird')
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>