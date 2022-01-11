@extends('layouts.vendor')
@section('head')
    <script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}" />
@endsection
@section('content')
    <section class="bc-items-listing">
        <div class="bc-section__content">
            <div class="d-flex justify-content-between mb-4">
                <div class="">
                    <h2>{{$page_title ?? ''}}</h2>
                    @if($row->slug)
                        <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                            <input type="hidden" name="slug" value="{{$row->slug}}">
                        </p>
                    @endif
                </div>
                <div class="bc-section__actions">
                    @if(!empty($row->id))
                    <a class="btn btn-primary" href="{{$row->getDetailUrl()}}" target="_blank"><i class="fa fa-eye"></i> {{__('View Product')}}</a>
                    @endif
                </div>
            </div>
            @include('global.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <form action="{{route('vendor.product.store',['id'=>$row->id])}}" method="post">
                @csrf
            <div class="@if($row->id) lang-content-box @endif">
                <div class="panel product-information-tabs">
                    <div class="panel-title d-flex justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <strong class="flex-shrink-0 me-3">{{__("Product Information")}}</strong>
                            <select @if(!is_default_lang()) readonly="" disabled @endif class="form-select" name="product_type">
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
                                        <li class="nav-item" @if(!empty($tab['condition'])) data-condition="{{$tab['condition']}}" @endif><a class="nav-link @if(!$i) active @endif"  href="#{{$tab_id}}" data-bs-toggle="tab">
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
                        <div class="text-end">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{__('Save changes')}} </button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </section>
@endsection
@section('footer')
    <script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>
    <script src="{{theme_url('/Base/vendor/js/form.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endsection
