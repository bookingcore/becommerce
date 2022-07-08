<div class="variation-actions">
    <div class="row">
        <div class="col-xl-8">
            <div class="d-flex align-items-center flex items-center">
                <div class="mr-3 flex-shrink-0" ><strong>{{__('Bulk Action')}}: </strong></div>
                <div class="grow">
                    <div class="input-group ajax-bulk-action-variations d-flex align-items-center flex items-center " >
                        <select class="form-control grow !rounded-r-none">
                            <option value="add">{{__('Add variation')}}</option>
                        </select>
                        <div class="input-group-append shrink-0">
                            <button class="btn btn-info !rounded-l-none h-full btn btn-info bg-blue-700 hover:bg-blue-800 focus:ring-blue-500 text-white" type="button" ><i class="fa fa-hand-o-right"></i> {{__('Go')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="@if(!empty($tailwind)) block mt-5 pb-4 @endif">
<div class="variation-list">

</div>
<hr class="@if(!empty($tailwind)) block mt-5 pb-4 @endif">
<a href="#" class="btn btn-primary btn-sm btn-save-variations"><i class="fa fa-save"></i> {{__('Save variations')}}</a>
