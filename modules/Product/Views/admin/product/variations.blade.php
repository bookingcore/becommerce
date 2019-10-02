@php
$attributes =  \Modules\Core\Models\Attributes::ofType($product->type)->get();
@endphp

    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <div class="">
                <h1 class="title-bar">{{__("Variations Managements")}}</h1>
            </div>
        </div>
        <div class="panel">
            <div class="panel-title">
                <div class="d-flex justify-content-between">
                    <strong>{{__("Variations")}}</strong>
                    <div class="panel-actions">
                        <a href="#" data-toggle="modal" data-target="#modalManageAttribute" class="btn btn-sm btn-primary"><i class="fa fa-cogs"></i> {{__("Manage Attributes")}}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">

            </div>
        </div>
        <div class="modal fade bravo-form" id="modalManageAttribute">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__("Manage Attributes")}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30%">
                                        {{__('Attribute')}}
                                    </th>
                                    <th width="60%"> {{__('Values')}} </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($product->attributes_for_variation) and is_array($product->attributes_for_variation))
                                    @foreach($product->attributes_for_variation as $attr_id)
                                        <tr >
                                            <td>
                                                <select  class="custom-select" name="attributes_for_variation[]">
                                                    <option value="">{{__('-- Please Select --')}}</option>
                                                    @foreach($attributes as $attribute)
                                                        <option value="{{$attribute->id}}" @if($attr_id == $attribute->id) selected @endif>{{$attribute->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="has-select2" name="term_ids[]" multiple >
                                                    @php $terms = $product->getTermsOfAttr($attr_id) @endphp
                                                    @foreach($terms as $term)
                                                        <option value="{{$term->id}}" selected>{{$term->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><a href="#"  class="btn btn-sm btn-danger btn-delete-attr-row"><i class="fa fa-trash"></i> </a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary btn-sm btn-add-att-row"><i class="fa fa-plus"></i> {{__('Add Attribute')}} </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="d-none sample-row">
                                    <td>
                                        <select  class="custom-select" __name__="attributes_for_variation[]">
                                            <option value="">{{__('-- Please Select --')}}</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="has-select2" name="term_ids[]" multiple >
                                        </select>
                                    </td>
                                    <td><a href="#"  class="btn btn-sm btn-danger btn-delete-attr-row"><i class="fa fa-trash"></i> </a></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button class="btn btn-success btn-save-attributes" ><i class="fa fa-save"></i> {{__('Save Attributes')}}
                            <i class="fa fa-spinner fa-spin fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section ('script.body')
    <script>
        reloadSelect2();
        $('.btn-add-att-row').click(function () {
            var h = $('.sample-row').clone();
            h.removeClass('d-none');
            h.find('[__name__]').each(function () {
                $(this).attr('name',$(this).attr('__name__'));
            })
            $(this).closest('table').find('tbody').append(h);
            window.setTimeout(function () {
                reloadSelect2();
            },150)
        })

        $(document).on('click','.btn-delete-attr-row',function () {
            if(confirm('{{__('Do you want to delete?')}}')){
                $(this).closest('tr').remove();
            }
        });

        function reloadSelect2(){
            $('.has-select2').select2({
                tags: true,
                width:'100%'
            })
        }

        $('.btn-save-attributes').click(function () {
            var p = $(this).closest('.modal');
            p.addClass('loading');
            $.ajax({
                url:'{{route('product.admin.variation.store_attrs',['id'=>$product->id])}}',
                method:'post',
                data:p.find('input,textarea,select').serialize(),
                success:function (json) {
                    p.removeClass('loading');
                    if(json.message){
                        bookingCoreApp.showAjaxMessage(json);
                    }
                },
                error:function () {
                    bookingCoreApp.showError(e);
                }
            })
        });
    </script>
@endsection