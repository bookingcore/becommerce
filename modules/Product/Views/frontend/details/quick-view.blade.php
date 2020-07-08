@if(!empty($row))
<script type="text/javascript">
    Bravo.variations = {!! $variations_product !!}
</script>
<div id="product-{{$row->id}}>" class="col-xs-6 col-sm-12 product">
    <div class="mf-product-detail">
        <div class="product-gallery">
            @php $galleries = explode(',',$row->gallery); @endphp
            @if(!empty($galleries))
                @foreach($galleries as $gallery_id)
                    <div class="item">
                        {!! get_image_tag($gallery_id,'full',['lazy'=>false,'alt'=>'gallery']) !!}
                    </div>
                @endforeach
            @endif
        </div>

        @include('Product::frontend.details.meta')

    </div>
</div>
@endif
