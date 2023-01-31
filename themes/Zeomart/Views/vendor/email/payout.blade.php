@extends('layouts.email')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3>{{__('Hello :display_name',['display_name'=>$vendor->display_name ?? ''])}},</h3>
            <p>{{__('We wanted to let you know that your payout for earnings up until the end of :date has been calculated',['date'=>$payout->date->format('F Y')])}}.</p>
            <p>{{__('Your payout will be: ').format_money($payout->total)}}.</p>
            <p>{{__('Regards')}},</p>
            <p>{{setting_item('site_title')}}</p>
        </div>
    </div>
@endsection
