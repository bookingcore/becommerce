@extends('layouts.vendor')
@push('head')
    <style>
        .bc-table .address-title{
            font-size: 16px;
        }
    </style>
@endpush
@section('content')
    <section class="bc-items-listing">
        <div class="flex justify-between mb-16">
            <h1 class="text-3xl font-medium">{{$page_title ?? ''}}</h1>
        </div>

        @include('global.message')
        <div class="panel">
            <div class="  py-3">
                <div class="grid gap-4 grid-cols-12">
                    <div class="col-md-6 col-span-4">
                        @include('vendor.order.actions')
                    </div>
                    <div class="col-md-6 col-span-8">@include('vendor.order.filter')</div>
                </div>
            </div>
            <div class="bc-section__content">
            <div class="table-responsive">
                <table class="table bc-table text-[15px] w-full" cellspacing="0" cellpadding="0">
                    <thead class="bg-[#F3F5F6]">
                        <tr>
                            <th class="p-3 py-4 rounded-l-md font-medium">
                                <div class="form-check">
                                    <input class="form-check-input check-all" type="checkbox" value="" >
                                </div>
                            </th>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Product Name')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Revenue')}}</th>
                            <th>{{__('Fee')}}</th>
                            <th>{{__('Net')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="p-3 rounded-r-md font-medium"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="check-item form-check-input" name="ids[]" value="{{$row->id}}">
                                </div>
                            </td>
                            <td>#{{$row->id}}</td>
                            <td>
                                <?php $product = $row->model ?>
                                <strong>{{$product->title ?? ''}}: {{format_money($row->price)}} x {{$row->qty}}</strong>
                                {{$product->sku ?? ''}}
                            </td>
                            <td>
                                @include('order.emails.parts.order-address',['order'=>$row->order])
                            </td>
                            <td><strong>{{format_money($row->subtotal)}}</strong>
                            <td><strong>{{format_money($row->commission_amount)}}</strong>
                            <td><strong>{{format_money($row->subtotal - $row->commission_amount)}}</strong>
                            </td>
                            <td><span class="badge bg-{{$row->status_badge}}">{{$row->status_text}}</span></td>
                            <td>{{display_datetime($row->created_at)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if(!count($rows))
                <div class="alert alert-warning">{{__("No data found")}}</div>
            @endif
            <div class="p-3">{{$rows->appends(request()->query())->links()}}</div>
        </div>
        </div>
    </section>
@endsection
@push('footer')
    <script>
        document.querySelector('.check-all').addEventListener('click',function(e){
            var items = document.querySelectorAll('tbody .check-item');
            for(var i = 0; i < items.length; i++) {
                items[i].checked = e.target.checked;
            }
        })
        $('.btn-apply-form').click(function (e) {
            var $this = $(this);
            let ids = '';
            $(".check-item").each(function () {
                if($(this).is(":checked")){
                    ids += '<input type="hidden" name="ids[]" value="'+$(this).val()+'">';
                }
            });
            $this.closest('form').append(ids).submit();
        });
    </script>
@endpush
