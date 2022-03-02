@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <h3 class="mt-2 mt-md-4 mb-4">{{ __("Overview") }}</h3>
        <hr>
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="panel report-panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <ul class="select-date-ranger">
                            <li class="@if(request()->get('range') == 'year') active @endif"><a href="{{ route('report.admin.overview').'?range=year' }}">{{ __("Year") }}</a></li>
                            <li class="@if(request()->get('range') == 'last-month') active @endif"><a href="{{ route('report.admin.overview').'?range=last-month' }}">{{ __("Last month") }}</a></li>
                            <li class="@if(request()->get('range') == 'this-month') active @endif"><a href="{{ route('report.admin.overview').'?range=this-month' }}">{{ __("This month") }}</a></li>
                            <li class="@if(request()->get('range') == 'last7days') active @endif"><a href="{{ route('report.admin.overview').'?range=last7days' }}">{{ __("Last 7 days") }}</a></li>
                            <li class="@if(request()->get('range') == 'custom') active @endif">
                                <form method="GET" action="{{ route('report.admin.overview') }}" class="filter-form filter-form-left d-flex justify-content-start">
                                    <input type="hidden" name="range" value="custom">
                                    <div id="reportrange" class="mr-2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <button class="btn btn-default" type="submit">{{ __("OK") }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="report-body-tab">
                            <div class="report-sidebar">
                                <ul class="chart-list-item">
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>{{ __("gross sales in this period") }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>{{ __("net sales in this period") }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>0</strong>
                                            <span>{{ __("orders placed") }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>0</strong>
                                            <span>{{ __("items purchased") }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>refunded 0 orders (0 items)</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>charged for shipping</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>worth of coupons used</span>
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

    </div>
@endsection

@section('script.body')
    <script src="{{url('libs/chart_js/Chart.min.js')}}"></script>
    <script src="{{url('libs/daterange/moment.min.js')}}"></script>
    <script src="{{url('libs/daterange/daterangepicker.min.js?_ver='.config('app.version'))}}"></script>
    <script>

        $('.report_chart').each(function () {
            console.log(report_chart_data);
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
                        yAxes: [{
                            stacked: true,
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '{{__("Currency: :currency_main",['currency_main'=>setting_item('currency_main')])}}'
                            },
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
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

        var start = moment().startOf('month');
        var end = moment();
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
            console.log(112);
        });
        cb(start, end);
    </script>
@endsection
