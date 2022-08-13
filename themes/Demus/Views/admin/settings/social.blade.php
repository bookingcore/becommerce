<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/5/2022
 * Time: 9:45 AM
 */
?>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Social Style")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('General Options')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Facebook")}}</label>
                    <div class="form-controls">
                        <label for="demus_social_facebook"></label>
                        <input id="demus_social_facebook" type="text" name="demus_social_facebook" class="form-control" value="{{setting_item("demus_social_facebook")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Twitter")}}</label>
                    <div class="form-controls">
                        <label for="demus_social_twitter"></label>
                        <input id="demus_social_twitter" type="text" name="demus_social_twitter" class="form-control" value="{{setting_item("demus_social_twitter")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Instagram")}}</label>
                    <div class="form-controls">
                        <label for="demus_social_instagram"></label>
                        <input id="demus_social_instagram" type="text" name="demus_social_instagram" class="form-control" value="{{setting_item("demus_social_instagram")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Linkedin")}}</label>
                    <div class="form-controls">
                        <label for="demus_social_linkedin"></label>
                        <input id="demus_social_linkedin" type="text" name="demus_social_linkedin" class="form-control" value="{{setting_item("demus_social_linkedin")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Pinterest")}}</label>
                    <div class="form-controls">
                        <label for="demus_social_pinterest"></label>
                        <input id="demus_social_pinterest" type="text" name="demus_social_pinterest" class="form-control" value="{{setting_item("demus_social_pinterest")}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


