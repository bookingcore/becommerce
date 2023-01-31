<?php
$active_campaign = $row->active_campaign;
if(!$active_campaign or !$active_campaign->isActiveNow()); return?>
<div class="event_counter_plugin_container mb30">
    <div class="event_counter_plugin_content">
        <ul class="bc_count_down" data-end="{{$active_campaign->format('Y-m-d 23:59:59')}}">
            <li><span class="bc-days"></span><div class="time_text">{{__('DAYS')}}</div></li>
            <li><span class="bc-hours"></span><div class="time_text">{{__('HOUR')}}</div></li>
            <li><span class="bc-minutes"></span><div class="time_text">{{__('MINS')}}</div></li>
            <li><span class="bc-seconds"></span><div class="time_text">{{__('SECS')}}</div></li>
        </ul>
    </div>
</div>

