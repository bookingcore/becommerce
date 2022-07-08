<div class="bc-section__header">
    <form  class="bc-form-apply d-flex justify-start flex" action="{{route('vendor.order.bulkEdit')}}" method="post">
        @csrf
        <div class="bc-form__left d-flex flex gap-4 items-center">
            <div class="me-3 grow">
                <select class="form-select" name="action">
                    <option value="">{{__("Bulk Actions")}}</option>
                    <optgroup label="{{__("Change order status to:")}}">
                        <option value="on_hold">{{__("On-Hold")}}</option>
                        <option value="processing">{{__('Processing')}}</option>
                        <option value="cancelled">{{__('Cancelled')}}</option>
                    </optgroup>
                </select>
            </div>
            <div class="shrink-0">
                <button class="inline-flex p-4 py-2 rounded items-center bg-blue-600 shadow-sm text-white hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    {{__('Apply')}}
                </button>
            </div>
        </div>
    </form>
</div>
