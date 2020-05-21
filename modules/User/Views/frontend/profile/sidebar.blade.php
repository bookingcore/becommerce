<?php $avatar = $user->getAvatarUrl(); ?>
<div class="bravo_profile_sidebar">
    <div class="profile-summary">
        <div class="profile-header">
            <div class="profile-avatar {{ !empty($avatar) ? 'avatar-img' : '' }}">
                @if($avatar)
                    <img src="{{$avatar}}" alt="{{$user->getDisplayName()}}">
                @else
                    <span class="avatar-text">{{$user->getDisplayName()[0]}}</span>
                @endif
            </div>
        </div>
        <div class="profile-content">
            @if($user->hasPermissionTo('dashboard_vendor_access'))
                <div class="profile-info">
                    <h3 class="display-name">{{$user->getDisplayName()}}</h3>
                    <p class="review_count">
                        {{trans_choice('[0,1] :count review|[2,*] :count reviews',$user->review_count)}}
                    </p>
                </div>
                <div class="profile-info">
                    <div class="profile-desc">
                        {!! $user->bio !!}
                    </div>
                </div>
                <p class="profile-address">
                    <span class="label">Address:</span>
                    <a href="{{ (!empty($user->address)) ? "http://maps.google.com/maps?&q=$user->address" : '' }}">{{ $user->address }}</a>
                </p>
                <div class="store-socials">
                    <span class="label">{{__('Follow us on social')}}</span>
                    <ul class="social-icons">
                        <li>
                            <a class="social-facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a class="social-instagram" href="//instagram.com/#" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="social-twitter" href="//twitter.com/#" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="social-googleplus" href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a class="social-youtube" href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a class="social-linkedin" href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="store-phone">
                    <span>{{__('Call us directly')}}</span>
                    <span class="phone-number">{{$user->phone}}</span>
                </div>
                <div class="store-contact">
                    {{__('Or contact seller via email')}}
                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                </div>
            @endif
        </div>
    </div>
    <div class="quick_info">
        <h4 class="title">Quick Info</h4>
        <div class="quick-info-wrapper">
            <p>Do you need more information? Write to us!</p>
            <form action="" method="post" id="respond" style="padding: 0;">
                @csrf
                <input type="text" class="input-text " name="quick_info[name]" value="" placeholder="Name">
                <input type="text" class="input-text " name="quick_info[subject]" value="" placeholder="Subject">
                <input type="email" class="input-text " name="quick_info[email]" value="" placeholder="Email">
                <textarea name="quick_info[message]" rows="5" placeholder="Message"></textarea>
                <input type="submit" class="submit" id="submit" name="quick_info[submit]" value="Submit">
            </form>
        </div>
    </div>
</div>
