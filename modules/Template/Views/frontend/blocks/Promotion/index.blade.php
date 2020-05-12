<div class="bravo_Promotion">
    <div class="martfury-container">
        <div class="row">
            @if(!empty($item))
                @foreach($item as $key=>$list)
                    @if($colItem == "big_and_small")
                        <div class="col-md-{{ $key == 0 ? "8" : "4" }}">
                            @if($key == 0)
                                @include("Template::frontend.blocks.Promotion.bigandsmall")
                            @else
                                @include("Template::frontend.blocks.Promotion.loop")
                            @endif
                        </div>
                    @else
                        <div class="col-sm-12 col-lg-{{$colItem ?? '4'}} col-md-6 col-xs-12">
                            @include("Template::frontend.blocks.Promotion.loop")
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
