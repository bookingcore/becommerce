<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/23/2022
 * Time: 1:24 AM
 */
?>
<section class="demus-news">
    <div class="container">
        @if(!empty($title))
            <div class="box-heading-title text-center mb-xl-3 pb-4 ">
                <h2 class="heading-title ">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
            </div>
        @endif
        <div class="row">
            @foreach($rows as $k=>$row)
                <div class="col-md-6 col-xl-4">
                    @include('news.loop')
                </div>
            @endforeach
        </div>
    </div>
</section>
