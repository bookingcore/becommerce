@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <h3 class="mt-2 mt-md-4 mb-4">{{ __("Revenue") }}</h3>
        <form method="GET" action="{{ route('report.admin.revenue') }}" class="filter-form filter-form-left d-flex justify-content-start">
            <div id="reportrange" class="mr-2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
        </form>
        <hr>
        <div class="row pt-2 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-pricetags"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Net sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-pricetags"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total tax</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cash"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Shipping</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cash"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Coupons</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-pricetag"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Returns</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-undo"></i>
                    </div>
                </div>
            </div>

        </div>

        <hr>

        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <strong>{{__('Total sales')}}</strong>
                    </div>
                    <div class="panel-body">
                        <canvas class="report_chart" data-chart="" style="max-height: 600px" ></canvas>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-title d-flex justify-content-between align-items-center">
                        <strong>{{__('Revenue')}}</strong>
                        <a href="#" class="btn btn-warning btn-icon"><i class="icon ion-md-cloud-download"></i> {{ __("Export to excel") }}</a>
                    </div>
                    <div class="panel-body">
                        <div class="mt-5 mb-5 text-center">
                            {{ __("No data recorded for this time period.") }}
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
            "showDropdowns": true,
            ranges: {
                '{{__("Today")}}': [moment(), moment()],
                '{{__('This Week')}}': [moment().startOf('week'), end],
                '{{__("This Month")}}': [moment().startOf('month'), moment().endOf('month')],
                '{{__("This Year")}}': [moment().startOf('year'), moment().endOf('year')],
                '{{__("Yesterday")}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '{{__('Last Week')}}': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                '{{__("Last Month")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '{{__("Last Year")}}': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        }, cb).on('apply.daterangepicker', function (ev, picker) {
            // Reload Earning JS
            console.log(112);
        });
        cb(start, end);
    </script>
@endsection
