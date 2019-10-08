@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Product Brand")}}</h1>
        </div>
        @include('Layout::admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Add Brand")}}</div>
                    <div class="panel-body">
                        <form action="{{route('product.admin.brand.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
                            @csrf
                            @include('Product::admin/brand/form',['parents'=>$rows])
                            <hr>
                            <div class="">
                                <button class="btn btn-success" type="submit">{{__("Add new")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('product.admin.brand.editBulk')}}" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Action ")}}</option>
                                    <option value="publish">{{__(" Publish ")}}</option>
                                    <option value="draft">{{__(" Move to Draft ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <input type="text" name="s" value="{{ Request()->s }}" class="form-control" placeholder="{{__("Search by name")}}">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit">{{__('Search')}}</button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th class="image" width="100px"></th>
                                    <th>{{__("Name")}}</th>
                                    <th class="slug d-none d-md-table-cell">{{__("Slug")}}</th>
                                    <th class="status">{{__("Status")}}</th>
                                    <th class="date d-none d-md-table-cell">{{__("Date")}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( count($rows) > 0)
                                    @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item">
                                        <td>
                                            @if($row->image_id)
                                                <img style="max-width: 80px;" src="{{get_file_url($row->image_id)}}" alt="">
                                            @endif
                                        </td>
                                        <td class="title">
                                            <a href="{{route('product.admin.brand.edit',['id'=>$row->id])}}">{{$row->name}}</a>
                                        </td>
                                        <td class="d-none d-md-block">{{$row->slug}}</td>
                                        <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                        <td class="d-none d-md-block">{{ display_date($row->updated_at)}}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
