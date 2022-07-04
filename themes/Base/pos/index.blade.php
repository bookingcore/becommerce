@extends('layouts.blank')
@push('head')
    <style>
        .footer{
            display: none;
        }
        body{
            margin: 0px!important;
        }
    </style>
@endpush
@section('content')
    <div id="pos_app" v-cloak class="bg-f1f1f1 vh-100" >
        <div class="d-flex h-100 flex-column">
            <div class="pos-header bg-main pt-2 pb-2 flex-shrink-0">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center">
                            <div class="flex-item me-5 flex-shrink-0">
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
                        <ul class="topbar-items nav justify-content-end">
                            @include('layouts.parts.header.user')
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="container-fluid flex-grow-1 overflow-hidden">
                <div class="row h-100 flex-nowrap">
                    <div class="col-md-7  overflow-auto py-3">
                        <pos-products @add="addProduct"/>
                    </div>
                    <div class="col-md-5 border-1 border-e1e1e1 bg-white ">
                        <div class="h-100 d-flex flex-column">
                            <div class="ps-2 pe-2 pt-2">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item" v-for="(order,index) in orders">
                                        <a class="nav-link " :class="{active:index === currentOrderIndex}" aria-current="page" href="#" @click.prevent="switchOrder(order,index)">@{{ order.title}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" @click.prevent="addOrder"><i class="fa fa-plus-circle"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <pos-order-items :order="currentOrder" @update="updateItem" @delete="deleteProduct"></pos-order-items>
                            <hr>
                            <pos-payment @submit="submitOrder" :shipping_methods="shipping_methods" :order="currentOrder"></pos-payment>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('footer')
    <script>
        window.i18n = Object.assign(window.i18n,{

        });
    </script>
    @include('global.components.pagination')
    @include('global.components.customer-dropdown')
    @include('pos.components.header.search')
    @include('pos.components.products')
    @include('pos.components.order-items')
    @include('pos.components.order-payment')
    @include('pos.components.order-customer')
    <script src="{{ asset('libs/lodash.min.js') }}"></script>
    <script src="{{theme_url('Base/pos/pos.js')}}"></script>
@endpush
