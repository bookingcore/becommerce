@extends('layouts.user')

@section('content')
    <form action="{{route('product.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" novalidate class="needs-validate">
        @csrf
        <div class="d-flex justify-content-between mb-2 align-items-end">
            <div>
                <h2 class="title-bar no-border-bottom">
                    {{($row->id and !request()->query('action')) ? __('Edit: name',['name'=>$row->title]) : __('Add new product')}}
                </h2>
                @if($row->slug)
                    <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        <input type="hidden" name="slug" value="{{$row->slug}}">
                    </p>
                @endif
            </div>
            <div>
                <div class="">
                    @if($row->id && $row->type == 'variable')
                        <a class="btn btn-warning btn-sm" href="{{route('product.admin.variation.index',['id'=>$row->id])}}" target=""><i class="fa fa-sliders"></i> {{__("Manage Variations")}}</a>
                    @endif
                    @if($row->slug)
                        <a class="btn btn-info btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank"> {{__("View Product")}} <i class="fa fa-arrow-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
        @include('Layout::admin.message')
        @if($row->id)
            @include('Language::admin.navigation')
        @endif
        <div class="lang-content-box">
            <div class="panel product-information-tabs">
                    <div class="panel-title d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <strong>{{__("Product Information")}}</strong>
                            <select @if(!is_default_lang()) readonly="" disabled @endif class="form-control" name="product_type">
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
                                        @php
                                        if(!empty($tab['hide_in_sub_language'])) continue;
                                        @endphp
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
    </form>
@endsection
@section('footer')
    <script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/condition.js?_ver='.config('app.version')) }}"></script>
    <script type="text/javascript" src="{{ asset('module/product/vendor/product.js?_ver='.config('app.version')) }}"></script>
@endsection
