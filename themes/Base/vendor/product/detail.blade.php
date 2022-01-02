@extends('layouts.vendor')
@section('head')
    <script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
@endsection
@section('content')
    <section class="ps-items-listing">
        <div class="ps-section__content">
            @include('global.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="panel product-information-tabs">
                    <div class="panel-title d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <strong class="flex-shrink-0 mr-3">{{__("Product Information")}}</strong>
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
    </section>
@endsection
@section('footer')
    <script src="{{theme_url('/Base/vendor/js/form.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endsection
