<div class="modal fade bd-example-modal-lg variation_form_modal"  id="variation_form_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span v-if="currentRow.id">{{__('Edit variation')}}</span>
                    <span v-else>{{__("Add variation")}}</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <vue-form-generator :schema="{fields:variationFormSchema}" :model="currentRow" :options="options"></vue-form-generator>
            </div>
            <div class="modal-footer">
                <span class="alert-text" v-show="lastVariationResponse.message" :class="lastVariationResponse.status ? 'success' : 'danger'">@{{lastVariationResponse.message}}</span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-success" @click="saveVariation($event)">
                    <span v-if="currentRow.id"><i class="fa fa-save"></i> {{__('Save changes')}}</span>
                    <span v-else><i class="fa fa-save"></i> {{__('Add new')}}</span>

                    <i class="fa fa-spin fa-spinner" v-show="onSavingVariation"></i>
                </button>
            </div>
        </div>
    </div>
</div>