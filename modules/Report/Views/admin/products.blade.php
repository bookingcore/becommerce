@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <h3 class="mt-2 mt-md-4 mb-4">{{ __("Products") }}</h3>
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="panel report-panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <ul class="select-date-ranger">
                            <li class="@if(request()->get('range') == 'year') active @endif"><a href="{{ route('report.admin.products').'?range=year' }}">{{ __("Year") }}</a></li>
                            <li class="@if(request()->get('range') == 'last-month') active @endif"><a href="{{ route('report.admin.products').'?range=last-month' }}">{{ __("Last month") }}</a></li>
                            <li class="@if(request()->get('range') == 'this-month') active @endif"><a href="{{ route('report.admin.products').'?range=this-month' }}">{{ __("This month") }}</a></li>
                            <li class="@if(request()->get('range', 'last7days') == 'last7days') active @endif"><a href="{{ route('report.admin.products').'?range=last7days' }}">{{ __("Last 7 days") }}</a></li>
                            <li class="@if(request()->get('range') == 'custom') active @endif">
                                <form method="GET" action="{{ route('report.admin.products') }}" class="filter-form filter-form-left d-flex justify-content-start">
                                    <input type="hidden" name="range" value="custom">
                                    <div id="reportrange" class="mr-2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" name="from" value="{{ request()->get('from') ?? date('Y-m-01') }}">
                                    <input type="hidden" name="to" value="{{ request()->get('to') ?? date('Y-m-d') }}">
                                    <button class="btn btn-default" type="submit">{{ __("OK") }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="report-body-tab">
                            <div class="report-sidebar">
                                <ul class="chart-list-item">
                                    <li style="border-left: 5px solid #b1d4ea">
                                        <div>
                                            <strong>{{ format_money($data_total['gloss_sales'] ?? 0) }}</strong>
                                            <span>{{ __("gross sales in this period") }}</span>
                                        </div>
                                    </li>
                                    <li style="border-left: 5px solid #3498db">
                                        <div>
                                            <strong>{{ format_money($data_total['net_sales'] ?? 0) }}</strong>
                                            <span>{{ __("net sales in this period") }}</span>
                                        </div>
                                    </li>
                                    <li style="border-left: 5px solid #dbe1e3">
                                        <div>
                                            <strong>{{ $data_total['orders_placed'] ?? 0 }}</strong>
                                            <span>{{ __("orders placed") }}</span>
                                        </div>
                                    </li>
                                    <li style="border-left: 5px solid #ecf0f1">
                                        <div>
                                            <strong>{{ $data_total['items_purchased'] ?? 0 }}</strong>
                                            <span>{{ __("items purchased") }}</span>
                                        </div>
                                    </li>
                                    <li style="border-left: 5px solid #5cc488">
                                        <div>
                                            <strong>{{ format_money($data_total['total_shipping'] ?? 0) }}</strong>
                                            <span>{{ __("charged for shipping") }}</span>
                                        </div>
                                    </li>
                                    <li style="border-left: 5px solid #f1c40f">
                                        <div>
                                            <strong>{{ format_money($data_total['coupons_used'] ?? 0) }}</strong>
                                            <span>{{ __("worth of coupons used") }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="report-chart">
                                <canvas class="report_chart" data-chart="" ></canvas>
                                <script>
                                    var report_chart_data = {!! json_encode($report_chart_data) !!};
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <p><i>{{__('Found :total items',['total'=>$listProduct->total()])}}</i></p>
                        <a href="{{route('report.admin.products.export',request()->except('page'))}}" class="btn btn-warning btn-icon"><i class="icon ion-md-cloud-download"></i> {{ __("Export to excel") }}</a>
                    </div>
                    <div class="panel-body">
                        @if($listProduct->total() >0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th>{{__("Product")}}</th>
                                        <th>{{__("Category")}}</th>
                                        <th>{{__('Items sold')}}</th>
                                        <th>{{__("Net sales")}}</th>
                                        <th>{{__("Status")}}</th>
                                        <th>{{__("Stock")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listProduct as $item=>$value)
                                        <tr>
                                            <td scope="row">
                                                <div class="media">
                                                    @if($value->image_id)
                                                        <div class="media-left" style="padding-right: 10px">
                                                            <div class="thumb" style="width: 50px;">
                                                                <img src="{{get_file_url($value->image_id)}}" width="50px" alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="media-body">
                                                        <a target="_blank" href="{{ route('product.detail',['slug'=>$value->slug])}}">{{ $value->title }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$value->categories->implode('name',',')}}</td>
                                            <td>{{$value->qty}}</td>
                                            <td>{{format_money($value->net_sales)}}</td>
                                            <td>
                                                @php
                                                    $stock_status = $value->getStockStatus();
                                                @endphp
                                                <span class="product-stock-status {{ $stock_status['in_stock'] ? 'in_stock' : 'out-of-stock'}}"><span><strong>{{$stock_status['stock']}}</strong></span></span>
                                            </td>
                                            <td>{{$value->remain_stock}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @else
                        <div class="mt-5 mb-5 text-center">
                            {{ __("No data recorded for this time period.") }}
                        </div
                        @endif
                    </div>
                    <div class="panel-footer">
                        {{$listProduct->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script.body')
    <script src="{{url('libs/chart_js/Chart.min.js')}}"></script>
    <script src="{{url('libs/daterange/moment.min.js')}}"></script>
    <script src="{{url('libs/daterange/daterangepicker.min.js?_ver='.config('app.version'))}}"></script>
    <script>

        $('.report_chart').each(function () {
            var ctx = $(this)[0].getContext('2d');
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: report_chart_data,
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            stacked: true,
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '{{__("Timeline")}}'
                            }
                        }],
                        yAxes: [
                            {
                                stacked: true,
                                display: true,
                                position: 'left',
                                id: 'y-axis-1',
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Currency: :currency_main",['currency_main'=>setting_item('currency_main')])}}'
                                },
                                ticks: {
                                    beginAtZero: true,
                                }
                            },
                            {
                                stacked: false,
                                display: true,
                                position: 'right',
                                id: 'y-axis-2',
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Items")}}'
                                },
                                ticks: {
                                    beginAtZero: true,
                                }
                            }
                        ],
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true,
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += tooltipItem.yLabel + " ({{setting_item('currency_main')}})";
                                return label;
                            }
                        }
                    }
                }
            });
        });

        var start = moment('{{ request()->get('from', date('Y-m-01')) }}');
        var end = moment('{{ request()->get('to', date('Y-m-d')) }}');
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            "alwaysShowCalendars": true,
            "opens": "right",
            "showDropdowns": true
        }, cb).on('apply.daterangepicker', function (ev, picker) {
            // Reload Earning JS
            $('input[name="from"]').val(picker.startDate.format('YYYY-MM-DD'))
            $('input[name="to"]').val(picker.endDate.format('YYYY-MM-DD'))
        });
        cb(start, end);
    </script>
@endpush
