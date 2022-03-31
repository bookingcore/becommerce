<?php
$translation = $row->translate();
?>
<div class="bc-post post for_blog">
    <div class="thumb">
        <div class="post_time"><span class="mont">{{month_translation($row->created_at->format('m') - 1)}}</span><br><span class="date">{{$row->created_at->format('d')}}</span></div>
        {!! get_image_tag($row->image_id,'medium',['class'=>'object-cover img-whp']) !!}
    </div>
    <div class="details">
        <div class="tc_content">
            @if($row->cat)
                <?php
                $cat_tran = $row->cat->translate();
                ?>
                <div class="tag bgc-thm">
                    <a class="text-white" href="{{$row->cat->getDetailUrl()}}">{{$cat_tran->name}}</a>
                </div>
            @endif
            <h4 class="title"><a href="{{$row->getDetailUrl()}}" >{{$translation->title}}</a></h4>
            <div class="bp_meta">
                <ul>
                    <li class="list-inline-item"><a href="#"><span class="flaticon-user fz15 mr10"></span> {{__('By :name',['name'=>$row->author->display_name ?? ''])}}</a></li>
                    @if($row->comments_count)
                    <li class="list-inline-item">
                        <a href="#"><span class="flaticon-chat fz15 mr10"></span>
                            @if($row->comments_count > 1) {{__(":count Comments",['count'=>$row->comments_count])}}
                            @else {{__(":count Comment",['count'=>$row->comments_count])}} @endif
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
