<div class="bc-section__header py-3">
    <form  class="bc-form-apply d-flex justify-content-start" action="{{route('vendor.order.bulkEdit')}}" method="post">
        @csrf
        <div class="bc-form__left d-flex">
            <div class="me-3">
                <select class="form-select" name="action">
                    <option value="">{{__("Bulk Actions")}}</option>
                    <optgroup label="{{__("Change order status to:")}}">
                        <option value="on_hold">{{__("On-Hold")}}</option>
                        <option value="processing">{{__('Processing')}}</option>
                        <option value="cancelled">{{__('Cancelled')}}</option>
                    </optgroup>
                </select>
            </div>
            <div>
                <button class="btn btn-primary btn-apply-form" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Apply')}}</button>
            </div>
        </div>
    </form>
</div>
