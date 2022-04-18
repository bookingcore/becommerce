<?php
$products = $row->products()->paginate(30);
?>
<div class="panel">
    <div class="panel-title"><strong>{{__("Add product to campaign")}}</strong></div>
    <div class="panel-body">
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($products))
                    <form method="post" action="{{route('campaign.admin.product.bulkEdit',['campaign'=>$row])}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="publish">{{__("Move to Publish")}}</option>
                            <option value="draft">{{__("Move to Draft")}}</option>
                            <option value="delete">{{__("Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-default btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="post" action="{{route('campaign.admin.product.add',['campaign'=>$row])}}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    @csrf
                    <input type="text" name="product_id"  placeholder="{{__('Search product')}}" class="form-control">
                    <button class="btn-default btn btn-icon btn_search" type="submit"><i class="fa fa-plus"></i> {{__('Add')}}</button>
                </form>
            </div>
        </div>
        <div class="bc-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th> {{ __('Name')}}</th>
                        <th width="100px"> {{ __('Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products->total() > 0)
                        @foreach($products as $product)
                            <tr class="{{$product->status}}">
                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$product->id}}">
                                </td>
                                <td class="title">
                                    <a target="_blank" href="{{route('product.admin.edit',['id'=>$product->id])}}">{{$product->title ? $product->title : __('(Untitled)')}}</a>
                                </td>
                                <td>{{ display_date($product->updated_at)}}</td>
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
        {{$products->appends(request()->query())->links()}}
    </div>
</div>
