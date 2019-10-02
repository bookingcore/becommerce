<?php
use Modules\Product\Models\ProductBrand;
$tabs = get_admin_product_tabs();
;?>

@extends('admin.layouts.app')

@section('content')
    <form action="{{route('product.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" novalidate class="needs-validate">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new product')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->id && $row->type == 'variable')
                        <a class="btn btn-warning btn-sm" href="{{route('product.admin.variation.index',['id'=>$row->id])}}" target=""><i class="fa fa-sliders"></i> {{__("Manage Variations")}}</a>
                    @endif
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View Product")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="panel product-information-tabs">
                    <div class="panel-title d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <strong>{{__("Product Information")}}</strong>
                            <select class="form-control" name="product_type">
                                <optgroup label="{{__("Product Type")}}">
                                    @foreach(get_product_types() as $type_id=>$type)
                                        <option @if($row->product_type == $type_id) selected @endif value="{{$type_id}}">{{$type::getTypeName()}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{__('Save changes')}} </button>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="row">
                            <div class="col-md-2 col-nav">
                                <ul class="nav nav-tabs  flex-column vertical-nav">
                                    @php $i = 0 @endphp
                                    @foreach($tabs as $tab_id=>$tab)
                                        <li class="nav-item" @if(!empty($tab['condition'])) data-condition="{{$tab['condition']}}" @endif><a class="nav-link @if(!$i) active @endif"  href="#{{$tab_id}}" data-toggle="tab">
                                            @if(!empty($tab['icon']))
                                            <i class="nav-icon {{$tab['icon']}}"></i>
                                            @endif
                                            {{$tab['title']}}</a>
                                        </li>
                                        @php $i++ @endphp
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-10 col-content">
                                <div class="tab-content">
                                @php $i = 0 @endphp
                                @foreach($tabs as $tab_id=>$tab)
                                    <div data-product-id="{{$row->id}}" class="tab-pane fade @if(!$i) show active @endif" id="{{$tab_id}}">
                                        @include($tab['view'],['product'=>$product])
                                    </div>
                                    @php $i++ @endphp
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{__('Save changes')}} </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endsection