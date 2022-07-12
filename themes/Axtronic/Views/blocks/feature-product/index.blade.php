<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/5/2022
 * Time: 8:32 AM
 */
$image = "";
$padding = 0;
if (!empty($bg_content)){
    $image = get_file_url( $bg_content ?? false,'full');
}
if (!empty($bg_content) || !empty($bg_color)){
    $padding = "60px 60px 30px";
}
?>

@if(!empty($rows->count()))
<div class="{{$width_style}}">
    <div class="axtronic-list-products axtronic-features axtronic-features-gird" style="background-image: url('{{ $image}}'); background-color: {{ $bg_color }}; padding: {{$padding}}">
        <div class="product-box-title {{ $style_header }} ">
            <h2 class="heading-title {{ $is_dark ? "dark" : 'light' }}">{!! clean($title) !!}</h2>
        </div>
        <ul class="nav list-items list-product-items axtronic-products-special">
            @if(!empty($rows))
                @foreach($rows as $key => $row)
                   @if($key == 0)
                        <li class="list-item product-style-2">
                            <div class="product-block">
                                <span class="hot-title mb-3">{{ $title_content }}</span>
                                <p class="text-center mb-5">{{ $content }}</p>
                                @include('product.search.loop')
                            </div>
                        </li>
                   @else
                        <li class="list-item product-style-1">
                            @include('product.search.loop-1')
                        </li>
                   @endif
                @endforeach
            @endif

        </ul>
    </div>
</div>
@endif
