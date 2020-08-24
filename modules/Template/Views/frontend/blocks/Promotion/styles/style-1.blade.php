<div class="bravo-promotion-style-1">
    <div class="container">
        <div class="row">
            @if(!empty($item))
                @foreach($item as $key=>$list)
                    <div class="col-sm-12 col-lg-{{$colItem ?? '4'}} col-md-6 col-xs-12">
                        @include("Template::frontend.blocks.Promotion.parts.loop")
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
