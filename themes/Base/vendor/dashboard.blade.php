@extends('layouts.vendor')
@section('head')
    <link rel="stylesheet" href="{{url('libs/daterange/daterangepicker.css')}}"/>
@endsection
@section('content')
    <section class="bc-dashboard">
        <div class="d-flex mb-3 align-items-center">
            <h1 class="me-3">{{__("Overview")}}</h1>
            <form action="" method="get">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                    <input type="hidden" name="from" value="{{request('from')}}">
                    <input type="hidden" name="to" value="{{request('to')}}">
                </div>
            </form>
        </div>
        <div class="row">
            @if(!empty($top_cards))
                @foreach($top_cards as $card)
                    <div class="col-sm-{{$card['size']}} col-md-{{$card['size_md']}}">
                        <div class="dashboard-report-card card {{$card['class']}}">
                            <div class="card-content">
                                <span class="card-title">{{$card['title']}}</span>
                                <span class="card-amount">{{$card['amount']}}</span>
                                <span class="card-desc">{{$card['desc']}}</span>
                            </div>
                            <div class="card-media">
                                <i class="{{$card['icon']}}"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6 mb-3">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <strong>{{__('Earning statistics')}}</strong>
                    </div>
                    <div class="panel-body">
                        <canvas id="earning_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 ">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between">
                        <strong>{{__('Recent Orders')}}</strong>
                        <a href="{{route('vendor.order')}}" class="btn-link">{{__("More")}}
                            <i class="icon ion-ios-arrow-forward"></i></a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px">#</th>
                                    <th>{{__("Product")}}</th>
                                    <th width="100px">{{__("Price")}}</th>
                                    <th width="100px">{{__("Qty")}}</th>
                                    <th width="100px">{{__("Subtotal")}}</th>
                                    <th width="100px">{{__("Commission")}}</th>
                                    <th width="100px">{{__("Earned")}}</th>
                                    <th width="100px">{{__("Status")}}</th>
                                    <th width="100px">{{__("Created At")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($recent_orders) > 0)
                                    @foreach($recent_orders as $order)
                                        <tr>
                                            <td>#{{$order->id}}</td>
                                            <td>
                                                @if($order->product)
                                                    <a href="{{$order->product->getDetailUrl()}}">{{$order->product->title}}</a>
                                                @endif
                                            </td>

                                            <td>{{format_money($order->price)}}</td>
                                            <td>{{$order->qty}}</td>
                                            <td>{{format_money($order->subtotal)}}</td>
                                            <td>{{format_money($order->commission_amount)}}</td>
                                            <td>{{format_money($order->subtotal - $order->commission_amount)}}</td>
                                            <td>
                                                <span class="badge bg-{{$order->status_badge}}">{{$order->status_text}}</span>
                                            </td>
                                            <td>{{display_datetime($order->created_at)}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script src="{{url('libs/chart_js/Chart.min.js')}}"></script>
    <script src="{{url('libs/daterange/moment.min.js')}}"></script>
    <script src="{{url('libs/daterange/daterangepicker.min.js?_ver='.config('app.version'))}}"></script>
    <script>
        var dashboard = {
            currency_main:'{{setting_item('currency_main')}}',
            y_label:'{{__("Currency: :currency_main",['currency_main'=>setting_item('currency_main')])}}',
            x_label:'{{__("Timeline")}}',
            ranges:{
                '{{__("Today")}}': [moment(), moment()],
                '{{__("Yesterday")}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '{{__("Last 7 Days")}}': [moment().subtract(6, 'days'), moment()],
                '{{__("Last 30 Days")}}': [moment().subtract(29, 'days'), moment()],
                '{{__("This Month")}}': [moment().startOf('month'), moment().endOf('month')],
                '{{__("Last Month")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '{{__("This Year")}}': [moment().startOf('year'), moment().endOf('year')],
                '{{__('This Week')}}': [moment().startOf('week'), moment()]
            },
            from:"{{request('from',date('Y-m-01'))}}",
            to:"{{request('to',date('Y-m-d'))}}"
        };
        var earning_chart_data = {!! json_encode($earning_chart_data) !!}
    </script>
    <script src="{{theme_url('Base/vendor/js/dashboard.js?_ver='.config('app.version'))}}"></script>
@endsection
