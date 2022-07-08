<div class="bc-section__header py-3">
    <div class="bc-section__filter">
        <form class="bc-form--filter d-flex justify-content-between" action="" method="get">
            <div class="bc-form__left d-flex">
                <div class="me-3">
                    <input class="form-control" type="text" name="s" value="{{request('s')}}" placeholder="{{__("Search by title")}}" />
                </div>
                <div>
                    <button class="btn btn-default" type="submit"><i class="icon icon-funnel mr-2"></i>{{__('Filter')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
