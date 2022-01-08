<div class="bc-section__header">
    <div class="bc-section__filter">
        <form class="bc-form--filter" action="" method="get">
            <div class="bc-form__left">
                <div class="form-group">
                    <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search product")}}" />
                </div>
                <div class="form-group">
                    <select class="bc-select">
                        <option value="1">Select Category</option>
                        <option value="2">Clothing & Apparel</option>
                        <option value="3">Clothing & Apparel</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="bc-select">
                        <option value="1">Product Type</option>
                        <option value="2">Simple Product</option>
                        <option value="3">Groupped product</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="bc-select" name="status">
                        <option value="">{{__('Status')}}</option>
                        <option @if(request('status') == 'publish') selected @endif value="publish">{{__('Publish')}}</option>
                        <option @if(request('status') == 'pending') selected @endif value="pending">{{__("Pending")}}</option>
                        <option @if(request('status') == 'draft') selected @endif value="draft">{{__("Draft")}}</option>
                    </select>
                </div>
            </div>
            <div class="bc-form__right">
                <button class="btn btn--gray" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Filter')}}</button>
            </div>
        </form>
    </div>
</div>
