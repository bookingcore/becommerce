@if($logo_id = setting_item("logo_id"))
    <?php $logo = get_file_url($logo_id,'full') ?>
    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
@else
    <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>
@endif
