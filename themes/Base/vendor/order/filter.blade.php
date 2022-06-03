<div class="bc-section__header py-3">
    <div class="bc-section__filter">
        <form class="bc-form--filter d-flex justify-content-between" action="" method="get">
            <div class="bc-form__left d-flex">
                <div class="me-3">
                    <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search Product ID or Order ID")}}" />
                </div>
                <div class="me-3">
                    <select class="form-select" name="status">
                        <option value="">{{__('-- Status --')}}</option>
                        <option @if(request('status') == 'on_hold') selected @endif value="pending">{{__("On-Hold")}}</option>
                        <option @if(request('status') == 'processing') selected @endif value="publish">{{__('Processing')}}</option>
                        <option @if(request('status') == 'completed') selected @endif value="publish">{{__('Completed')}}</option>
                        <option @if(request('status') == 'failed') selected @endif value="publish">{{__('Failed')}}</option>
                        <option @if(request('status') == 'refunded') selected @endif value="publish">{{__('Refunded')}}</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-default" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Filter')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
