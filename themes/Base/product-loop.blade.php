<a class="block relative h-48 rounded overflow-hidden">
    {!! get_image_tag($row->image_id,'medium',['class'=>'object-cover object-center w-full h-full block','alt'=>$row->title]) !!}
</a>
<div class="mt-4">
    @if($row->categories)
    <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{$row->categories->pluck('name')->join(', ')}}</h3>
    @endif
    <h2 class="text-gray-900 title-font text-lg font-medium">{{$row->title}}</h2>
    <p class="mt-1">{{format_money($row->price)}}</p>
</div>
