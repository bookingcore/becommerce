<div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Review Options")}}</h3>
            <p class="form-group-desc">{{__('Config review for product')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Write review")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="zeomart_vendor_enable_review" value="1" @if(!empty(setting_item('zeomart_vendor_enable_review'))) checked @endif /> {{__("On Review")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Turn on the mode for reviewing product")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="zeomart_vendor_enable_review:is(1)">
                        <label class="" >{{__('Reviews can only be left by "verified owners"')}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="zeomart_vendor_review_verification_required" value="1"  @if(!empty(setting_item('zeomart_vendor_review_verification_required'))) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("ON: Only post a review after order - Off: Post review without order")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="zeomart_vendor_enable_review:is(1)">
                        <label class="" >{{__("Review approved")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="zeomart_vendor_review_approved" value="1"  @if(!empty(setting_item('zeomart_vendor_review_approved'))) checked @endif /> {{__("On approved")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("ON: Review must be approved by admin - OFF: Review is automatically approved")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="zeomart_vendor_enable_review:is(1)">
                        <label class="" >{{__("Review number per page")}}</label>
                        <div class="form-controls">
                            <input type="number" class="form-control" name="zeomart_vendor_review_number_per_page" value="{{ setting_item('zeomart_vendor_review_number_per_page' , 5) }}" />
                            <small class="form-text text-muted">{{__("Break comments into pages")}}</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
