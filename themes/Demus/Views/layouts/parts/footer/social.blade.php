<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/5/2022
 * Time: 9:57 AM
 */
?>
<div class="social-link mt-3">
    <ul class="d-flex flex-wrap footer-social list-unstyled m-0">
        @if(!empty(setting_item('demus_social_facebook')))
            <li class="social-icons-item">
                <a class="social-icons--link text-center position-relative" href="{{ setting_item('demus_social_facebook') }}" title="Facebook">
                    <i class="axtronic-icon-facebook"></i>
                </a>
            </li>
        @endif
        @if(!empty(setting_item('demus_social_twitter')))
            <li class="social-icons-item">
                <a class="social-icons--link text-center position-relative" href="{{setting_item('demus_social_twitter')}}" title="Twitter">
                    <i class="axtronic-icon-twitter"></i>
                </a>
            </li>
        @endif
        @if(!empty(setting_item('demus_social_instagram')))
            <li class="social-icons-item">
                <a class="social-icons--link text-center position-relative" href="{{setting_item('demus_social_instagram')}}" title="Instagram">
                    <i class="axtronic-icon-instagram"></i>
                </a>
            </li>
        @endif
        @if(!empty(setting_item('demus_social_linkedin')))
            <li class="social-icons-item">
                <a class="social-icons--link text-center position-relative" href="{{setting_item('demus_social_linkedin')}}" title="Linkedin">
                    <i class="axtronic-icon-linkedin"></i>
                </a>
            </li>
        @endif
        @if(!empty(setting_item('demus_social_pinterest')))
            <li class="social-icons-item">
                <a class="social-icons--link text-center position-relative" href="{{setting_item('demus_social_pinterest')}}" title="Instagram">
                    <i class="axtronic-icon-pinterest-p"></i>
                </a>
            </li>
        @endif
    </ul>
</div>
