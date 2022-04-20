<?php
$campaign_products = $row->campaign_products()->with(['product'])->paginate(30);
?>
<div class="panel">
    <div class="panel-title"><strong>{{__("Add product to campaign")}}</strong></div>
    <div class="panel-body">
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                @if(!empty($campaign_products))
                    <form method="post" action="{{route('campaign.admin.product.bulkEdit',['campaign'=>$row])}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="active">{{__("Move to Active")}}</option>
                            <option value="draft">{{__("Move to Pending")}}</option>
                            <option value="delete">{{__("Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-default btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="post" action="{{route('campaign.admin.product.add',['campaign'=>$row])}}" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row align-items-center" role="search">
                    @csrf
                    <?php
                    \App\Helpers\AdminForm::select2('product_id', [
                        'configs' => [
                            'ajax'        => [
                                'url'      => route('campaign.admin.product.search',['campaign'=>$row]),
                                'dataType' => 'json'
                            ],
                            'allowClear'  => true,
                            'placeholder' => __('-- Search Product --')
                        ]
                    ])
                    ?>
                    <button class="btn-success btn btn-icon btn_search align-items-center" type="submit"><i class="fa fa-plus mr-2"></i> {{__('Add')}}</button>
                </form>
            </div>
        </div>
        <div class="bc-form-item">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="60px"><input type="checkbox" class="check-all"></th>
                        <th width="110px" align="center"> {{ __('Product ID')}}</th>
                        <th> {{ __('Name')}}</th>
                        <th> {{ __('Current Price')}}</th>
                        <th> {{ __('Sale Price')}}</th>
                        <th> {{ __('Status')}}</th>
                        <th width="100px"> {{ __('Added on ')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($campaign_products->total() > 0)
                        @foreach($campaign_products as $campaign_product)
                            <tr class="{{$product->status}}">
                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$campaign_product->id}}">
                                </td>
                                <td>#{{$campaign_product->product_id}}</td>
                                <td class="title">
                                    @if($campaign_product->product)
                                        <a target="_blank" href="{{route('product.admin.edit',['id'=>$campaign_product->product->id])}}">{{$campaign_product->product->title}}</a>
                                    @else
                                        [{{__('Deleted')}}]
                                    @endif
                                </td>
                                <td>{{format_money($campaign_product->price ?? 0)}}</td>
                                <td>{{format_money($campaign_product->discounted_price ?? 0)}}</td>
                                <td><span class="badge badge-{{ $campaign_product->status_badge }}">{{ $campaign_product->status }}</span></td>
                                <td>{{ display_date($campaign_product->updated_at)}}</td>
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
        {{$campaign_products->appends(request()->query())->links()}}
    </div>
</div>
