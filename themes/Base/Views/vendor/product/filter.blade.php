<div class="bc-section__header py-3">
    <div class="bc-section__filter">
        <form class="bc-form--filter d-flex justify-content-between" action="" method="get">
            <div class="bc-form__left d-flex">
                <div class="me-3">
                    <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search product")}}" />
                </div>
                <div class="me-3">
                    <select class="form-select" name="product_type">
                        <option value="">{{__("-- Product Type--")}}</option>
                        @foreach(get_product_types() as $type_id=>$type)
                            <option @if($type_id == request('product_type')) selected @endif value="{{$type_id}}">{{$type::getTypeName()}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="me-3">
                    <select class="form-select" name="status">
                        <option value="">{{__('-- Status --')}}</option>
                        <option @if(request('status') == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                        <option @if(request('status') == 'pending') selected @endif value="pending">{{__("Pending")}}</option>
                        <option @if(request('status') == 'draft') selected @endif value="draft">{{__("Draft")}}</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-default" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Filter')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
