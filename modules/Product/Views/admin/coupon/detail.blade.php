@extends('admin.layouts.app')
@push('script.head')
    <link href="{{asset('libs/daterange/daterangepicker.css')}}" rel="stylesheet">
@endpush

@section('content')
    <form action="{{route('product.coupon.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" class="dungdt-form">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new coupon')}}</h1>
                </div>
            </div>
            @include('Layout::admin.message')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        @include('Product::admin.coupon.form')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                <div>
                                    <label><input checked type="radio" name="status" value="publish"> {{__("Publish")}}</label>
                                </div>
                                <div>
                                    <label><input type="radio" name="status" value="draft"> {{__("Draft")}}</label>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push ('script.body')
    <script src="{{asset('/libs')}}/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{asset('/libs')}}/daterange/moment.min.js"></script>
    <script type="text/javascript" src="{{asset('/libs')}}/daterange/daterangepicker.min.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('.form-expiration').each(function () {
                var nowDate = new Date();
                var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
                var parent = $(this),
                    date_wrapper = $('.date-wrapper', parent),
                    check_in_out = $('.check-in-out', parent);
                var options = {
                    singleDatePicker: false,
                    autoApply: true,
                    disabledPast: true,
                    customClass: '',
                    widthSingle: 300,
                    onlyShowCurrentMonth: true,
                    minDate: today,
                    opens: bookingCore.rtl ? 'right':'left',
                    locale: {
                        format: "MM/DD/YYYY",
                        direction: bookingCore.rtl ? 'rtl':'ltr',
                        firstDay:daterangepickerLocale.first_day_of_week
                    }
                };

                if (typeof  daterangepickerLocale == 'object') {
                    options.locale = _.merge(daterangepickerLocale,options.locale);
                }
                check_in_out.daterangepicker(options).on('apply.daterangepicker',
                    function (ev, picker) {
                        if (picker.endDate.diff(picker.startDate, 'day') <= 0) {
                            picker.endDate.add(1, 'day');
                        }
                        check_in_out.val( picker.startDate.format("MM/DD/YYYY") + " - "+  picker.endDate.format("MM/DD/YYYY") )
                    });
                date_wrapper.on('click',function (e) {
                    check_in_out.trigger('click');
                });
            });
        })
    </script>
@endpush
