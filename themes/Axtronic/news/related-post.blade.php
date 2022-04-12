<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/21/2022
 * Time: 4:32 PM
 */
?>
<div class="related-post">
    <h5 class="post-title text-center mt-5">{{ __('You Might Also Like') }}</h5>
    <div class="post-content">
        <div class="row">
            @foreach($related_post as $post)
                @php $translation = $post->translate(); @endphp
                <div class="col-lg-4">
                    <div class="post-review">
                        <a href="{{ $post->getDetailUrl() }}">
                            <img class="img-cover" src="{{ get_file_url($post->image_id) }}" alt="{{ $translation->title }}">
                        </a>
                    </div>
                    <div class="post-body">
                        <h6 class="post-title">{{ $translation->title }}</h6>
                        <p class="m-0 post-date opacity-75">{{ display_date($post->created_at) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{--<nav class="navigation post-navigation" aria-label="Posts">--}}
    {{--<div class="nav-links">--}}
        {{--<div class="nav-previous">--}}
            {{--<a href="#" rel="prev">--}}
                {{--<div class="nav-content has-image">--}}
                    {{--<div class="image">--}}
                        {{--<img src="https://demothemedh.b-cdn.net/axtronic/wp-content/uploads/2020/10/unsplash_glRqyWJgUeY.jpg"  alt="">--}}
                    {{--</div>--}}
                    {{--<div class="inner-action">--}}
                        {{--<span class="reader-text"><i class="axtronic-icon-angle-left"></i>Previous Post </span>--}}
                        {{--<span class="title">Tuesday Tips: Being Realistic With Your Goals</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="nav-next">--}}
            {{--<a href="#" rel="next">--}}
                {{--<div class="nav-content has-image">--}}
                    {{--<div class="inner-action">--}}
                        {{--<span class="reader-text">Next Post <i class="axtronic-icon-angle-right"></i></span>--}}
                        {{--<span class="title">We Invite You to These Wonderful Wine Tasting Events</span>--}}
                    {{--</div>--}}
                    {{--<div class="image">--}}
                        {{--<img src="https://demothemedh.b-cdn.net/axtronic/wp-content/uploads/2020/10/unsplash_glRqyWJgUeY.jpg" alt="">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}
