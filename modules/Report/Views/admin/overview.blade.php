@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <h5 class="mt-2 mt-md-4">{{ __("Date range") }}</h5>
        <form method="GET" action="{{ route('report.overview') }}" class="filter-form filter-form-left d-flex justify-content-start">
            <select class="form-control" name="period">
                <option value="today">{{ __("Today") }}</option>
                <option value="week">{{ __("Week to date") }}</option>
                <option value="month">{{ __("Month to date") }}</option>
                <option value="quarter">{{ __("Quarter to date") }}</option>
                <option value="year">{{ __("Year to date") }}</option>
                <option value="yesterday">{{ __("Yesterday") }}</option>
                <option value="last_week">{{ __("Last Week") }}</option>
                <option value="last_month">{{ __("Last Month") }}</option>
                <option value="last_quarter">{{ __("Last Quarter") }}</option>
                <option value="last_year">{{ __("Last Year") }}</option>
                <option value="custom">{{ __("Custom") }}</option>
            </select>
            <input type="text" value="" data-condition="period:is(custom)" placeholder="{{__("Start Date")}}" name="start_date" readonly class="form-control has-datepicker">
            <input type="text" value="" data-condition="period:is(custom)" placeholder="{{__("End Date")}}" name="end_date" readonly class="form-control has-datepicker">
            <button type="submit" class="btn btn-default">{{ __("Update") }}</button>
        </form>
        <hr>
        <div class="row pt-2 mb-5">
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="summary-card card mb-3">
                    <div class="card-content">
                        <span class="card-title">Total sales</span>
                        <span class="card-amount">$0.00</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-cart"></i>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-0">{{ "Chart" }}</h4>
        <hr>

        <div class="row mb-5">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
@endsection
