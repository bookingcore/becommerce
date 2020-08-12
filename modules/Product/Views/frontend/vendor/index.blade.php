@extends('layouts.user')
@section('head')

@endsection
@section('content')
    <h2 class="title-bar">
        {{__("Manage Products")}}
        @if(Auth::user()->hasPermissionTo('product_create'))
            <a href="{{route('product.vendor.create')}}" class="btn-change-password">{{__("Add Product")}}</a>
        @endif
    </h2>
    <div class="bravo-list-item">
        <div class="bravo-pagination">
            <span class="count-string">{{ __("Showing :from - :to of :total products",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
            {{$rows->appends(request()->query())->links()}}
        </div>

        <div class="bravo-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th width="100px"> {{ __('Picture')}}</th>
                        <th> {{ __('Name')}}</th>
                        <th width="130px"> {{ __('Author')}}</th>
                        <th width="100px"> {{ __('Status')}}</th>
                        <th width="100px"> {{ __('Reviews')}}</th>
                        <th width="100px"> {{ __('Date')}}</th>
                        <th width="100px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($rows->total() > 0)
                        @foreach($rows as $row)
                            <tr class="{{$row->status}}">
                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                </td>
                                <td width="100px">
                                    @if($row->image_id)
                                        <img class="img-fluid" src="{{get_file_url($row->image_id,'thumb')}}" >
                                    @endif
                                </td>
                                <td class="title">
                                    <a href="{{route('product.vendor.edit',['id'=>$row->id])}}">{{$row->title ? $row->title : __('(Untitled)')}}</a>
                                </td>
                                <td>
                                    @if(!empty($row->author))
                                        {{$row->author->getDisplayName()}}
                                    @else
                                        {{__("[Author Deleted]")}}
                                    @endif
                                </td>
                                <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                <td>
                                    {{ $row->getNumberReviewsInService() }}
                                </td>
                                <td>{{ display_date($row->updated_at)}}</td>
                                <td>
                                    <a href="{{route('product.vendor.edit',['id'=>$row->id])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">{{__("No product found")}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bravo-pagination">
            <span class="count-string">{{ __("Showing :from - :to of :total products",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
            {{$rows->appends(request()->query())->links()}}
        </div>
    </div>
@endsection
@section('footer')

@endsection
