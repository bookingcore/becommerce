@extends('layouts.vendor')
@section('head')
@endsection
@section('content')
    <section class="bc-dashboard">
        <div class="d-flex mb-3 align-items-center">
            <h1 class="me-3">{{__("Payouts")}}</h1>
        </div>
        @if($payout_account)
            <div class="row">
                <div class="col-md-8">
                    @if($current_payout)
                    <h4 class="mb-4">{{__("Next Payout")}}</h4>
                    <p>{{format_money($current_payout->total)}}</p>
                    <p>{{__("via :method_name",['method_name'=>$current_payout->payout_method])}}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    @include("vendor.payout.setup")
                </div>
            </div>
        @else
            @include("vendor.payout.setup")
        @endif
        @if(count($payouts))
            <hr>
            <h4>{{__("Payout history")}}</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-booking-history">
                    <thead>
                    <tr>
                        <th width="2%">{{__("#")}}</th>
                        <th>{{__("Amount")}}</th>
                        <th>{{__("Payout Method")}}</th>
                        <th>{{__("Date Request")}}</th>
                        <th>{{__("Notes")}}</th>
                        <th>{{__("Date Processed")}}</th>
                        <th>{{__("Status")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payouts as $payout)
                        <tr>
                            <td>#{{$payout->id}}</td>
                            <th>{{format_money($payout->amount)}}</th>
                            <td>
                                {{__(':name to :info',['name'=>$payout->payout_method_name,'info'=>$payout->account_info])}}
                            </td>
                            <td>{{display_date($payout->created_at)}}</td>
                            <td>
                                @if($payout->note_to_admin)
                                    <label ><strong>{{__("To admin:")}}</strong></label>
                                    <br>
                                    <div>{{$payout->note_to_admin}}</div>
                                @endif
                                @if($payout->note_to_vendor)
                                    <label ><strong>{{__("To vendor:")}}</strong></label>
                                    <br>
                                    <div>{{$payout->note_to_vendor}}</div>
                                @endif
                            </td>
                            <td>{{$payout->pay_date ? display_date($payout->pay_date) : ''}}</td>
                            <td>{{$payout->status_text}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bravo-pagination">
                {{$payouts->appends(request()->query())->links()}}
            </div>
        @endif
    </section>
@endsection

@section('footer')
    <script src="{{theme_url('Base/vendor/js/dashboard.js?_ver='.config('app.version'))}}"></script>
@endsection
