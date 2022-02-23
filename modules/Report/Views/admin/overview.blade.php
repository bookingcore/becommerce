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
                            <li><a href="#">Year</a></li>
                            <li><a href="#">Last month</a></li>
                            <li><a href="#">This month</a></li>
                            <li class="active"><a href="#">Last 7 days</a></li>
                            <li>
                                <form method="GET" action="{{ route('report.admin.overview') }}" class="filter-form filter-form-left d-flex justify-content-start">
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
                                            <span>gross sales in this period</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>$0.00</strong>
                                            <span>net sales in this period</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>0</strong>
                                            <span>orders placed</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <strong>0</strong>
                                            <span>items purchased</span>
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
            var ctx = $(this)[0].getContext('2d');
            window.myMixedChart = new Chart(ctx, {
                type: 'bar',
                data: $(this).attr('data-chart'),
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    },
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
