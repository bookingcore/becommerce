@extends('layouts.blank')
@section('head')
    <style>
        .footer{
            display: none;
        }
        body{
            margin: 0px!important;
        }
    </style>
@endsection
@section('content')
    <div id="pos_app" v-cloak class="bg-f1f1f1 vh-100" >
        <div class="d-flex h-100 flex-column">
            <div class="pos-header bg-main p-3 flex-shrink-0">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="flex-item mr-5 flex-shrink-0">
                                @if($logo_id = setting_item("logo_id"))
                                    <?php $logo = get_file_url($logo_id,'full') ?>
                                    <img src="{{$logo}}" alt="{{setting_item("site_title")}}">
                                @else
                                    <span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="c-white fw-700">{{__("Commerce")}}</span></span>
                                @endif
                            </div>
                            <div class="flex-item flex-grow-1">
                                <pos-header-search @add="addProduct"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                </div>
            </div>
            <div class="row flex-grow-1">
                <div class="col-md-7">
                    <div class="pos-products">
                        <pos-products @add="addProduct"/>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="border-1 border-e1e1e1 bg-white h-100">
                        <div class="pl-2 pr-2 pt-2">
                            <ul class="nav nav-tabs">
                                <li class="nav-item" v-for="(order,index) in orders">
                                    <a class="nav-link " :class="{active:index === currentOrderIndex}" aria-current="page" href="#" @click.prevent="switchOrder(order,index)">@{{ order.title}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" @click.prevent="addOrder"><i class="fa fa-plus-circle"></i></a>
                                </li>
                            </ul>
                        </div>
                        <pos-order-items :order="currentOrder" @update="updateItem"></pos-order-items>
                        <pos-payment :order="currentOrder"></pos-payment>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer')
    @include('POS.components.header.search')
    @include('POS.components.products')
    @include('POS.components.order-items')
    @include('POS.components.order-payment')
    <script src="{{ asset('libs/lodash.min.js') }}"></script>
    <script src="{{theme_url('Base/pos/pos.js')}}"></script>
@endsection
