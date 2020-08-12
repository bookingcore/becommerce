@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Coupon")}}</h1>
            <div class="title-actions">
                <a href="{{route('product.coupon.create')}}" class="btn btn-primary">{{__("Add new coupon")}}</a>
            </div>
        </div>
        @include('Layout::admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('product.coupon.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="publish">{{__(" Publish ")}}</option>
                            <option value="draft">{{__(" Move to Draft ")}}</option>
                            <option value="clone">{{__(" Clone ")}}</option>
                            <option value="delete">{{__(" Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="{{route('product.admin.index')}} " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th> {{ __('Code')}}</th>
                                <th> {{ __('Coupon type')}}</th>
                                <th> {{ __('Coupon amount')}}</th>
                                <th width="100px"> {{ __('Status')}}</th>
                                <th width="130px"> {{ __('Usage / Limit')}}</th>
                                <th width="150px"> {{ __('Date Expiration')}}</th>
                                <th width="100px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <?php $type = ''; switch ($row->coupon_type) {
                                        case 'percent' : $type = __('Percentage discount'); break;
                                        case 'fixed_cart' : $type = __('Fixed basket discount'); break;
                                        case 'fixed_product' : $type = __('Fixed product discount'); break;
                                    } ?>
                                    <tr class="{{$row->status}}">
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                        </td>
                                        <td class="title">
                                            <a href="{{route('product.coupon.edit',['id'=>$row->id])}}">{{$row->name ? $row->name : __('(Untitled)')}}</a>
                                        </td>
                                        <td><span>{{ $type }}</span></td>
                                        <td>{{ $row->discount }}</td>
                                        <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                        <td>{!! (empty($row->usage)) ? 0 : $row->usage !!} / {!! (empty($row->per_coupon)) ? '&infin;' : $row->per_coupon !!}</td>
                                        <td>{{ !empty($row->expiration) ? str_replace(' - ',__(' to '),$row->expiration) : '' }}</td>
                                        <td>
                                            <a href="{{route('product.coupon.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">{{__("No coupon found")}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
