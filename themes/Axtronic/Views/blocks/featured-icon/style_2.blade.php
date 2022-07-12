<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/22/2022
 * Time: 4:08 PM
 */
?>
@if(!empty($list_items))
    <div class="axtronic-site-features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="item-image">
                        <img src="{{ get_file_url( $image ?? false,'full') }}" alt="">
                    </div>
                </div>
                @foreach($list_items as $item)
                    <div class="feature-item">
                        <div class="d-flex align-items-center justify-content-center box">
                            <div class="item-icon">
                                <i class="{{$item['icon'] ?? 'axtronic-icon-group'}}"></i>
                            </div>
                            <div class="item-content">
                                <h4 >{{ $item['title'] ?? '' }}</h4>
                                <p class="mb-0">{{$item['sub_title'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endif

