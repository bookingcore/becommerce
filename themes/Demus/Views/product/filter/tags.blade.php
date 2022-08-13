<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 10:20 AM
 */
?>
<?php
$tags = \Modules\Product\Models\ProductTag::search()->withCount(['products'])->orderByDesc('products_count')->take(9)->get();
if(!count($tags)) return;
?>

<h6 class="widget_title">{{__($widget['title'])}}</h6>
<div class="widget_content wiget-tag">
    @foreach($tags as $tag)
        <a  href="{{ route('product.index')."?tag=$tag->slug" }}" data-tag="{{$tag->slug}}">{{$tag->name}}</a>
    @endforeach
</div>

