<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 10:20 AM
 */
?>
<?php
$tags = \Modules\News\Models\Tag::search()->withCount(['product'])->orderByDesc('product_count')->take(9)->get();
if(!count($tags)) return;

?>

<h3 class="widget_title">{{__('Product Tags')}}</h3>
<div class="widget_content">
    @foreach($tags as $tag)
        <a href="#">{{$tag}}</a>
    @endforeach
</div>
