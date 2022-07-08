@extends('layouts.vendor')
@section('content')
    <section class="bc-dashboard">
        <div class="flex justify-between mb-16">
            <h1 class="text-3xl font-medium">{{$page_title ?? ''}}</h1>
        </div>
        <div class="panel">
            <div class="panel-body">
        @if($payout_account)
            <div class="grid grid-cols-12 gap-4">
                <div class="col-md-8 col-span-8 text-base">
                    <h4 class="text-2xl mb-4 font-medium">{{__("Payout history")}}</h4>
                    @if($current_payout)
                        <p class="lead">{{format_money($current_payout->total)}}</p>
                        <p class="lead">{{__("via :method_name",['method_name'=>$current_payout->method_name])}}</p>
                    @else
                        <p class="lead">{{__("You currently have :amount in earnings for next month's payout.",['amount'=>format_money($currentUser->availablePayoutAmount)])}}</p>
                    @endif
                </div>
                <div class="col-md-4 col-span-4">
                    @include("vendor.payout.setup")
                </div>
            </div>
        @else
            @include("vendor.payout.setup")
        @endif
            <hr class="block mt-5 pb-4">
            <h4 class="text-2xl mb-4 font-medium">{{__("Payout history")}}</h4>
            <div class="table-responsive">
                <table class="table bc-table text-[15px] w-full" cellspacing="0" cellpadding="0">
                    <thead class="bg-[#F3F5F6]">
                    <tr>
                        <th class="p-3 py-4 rounded-l-md font-medium" width="2%">{{__("#")}}</th>
                        <th>{{__("Amount")}}</th>
                        <th>{{__("Payout Method")}}</th>
                        <th>{{__("Date Created")}}</th>
                        <th class="rounded-r-md">{{__("Status")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payouts as $payout)
                        <tr>
                            <td>#{{$payout->id}}</td>
                            <th>{{format_money($payout->total)}}</th>
                            <td>
                                {{$payout->method_name}}
                            </td>
                            <td>{{display_date($payout->created_at)}}</td>
                            <td>{{$payout->status_text}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bravo-pagination">
                {{$payouts->appends(request()->query())->links()}}
            </div>
        </div>
        </div>
    </section>
@endsection

@push('footer')
    <script src="{{asset('module/vendor/js/payout.js')}}"></script>
@endpush
