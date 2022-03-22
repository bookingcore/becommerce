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
