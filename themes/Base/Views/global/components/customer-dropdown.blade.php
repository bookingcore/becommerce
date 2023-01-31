<script type="text/x-template" id="bc_customer_dropdown">
    <div class="bc-form--quick-search relative dropdown" v-click-outside="hideDropdown">
        <input class="form-control" ref="input" v-model="s" type="text" @click="openDropdown" @keyup="startSearch" :placeholder="placeholder">
        <i class="fa fa-spinner fa-spin fa-fw margin-bottom absolute" v-show="loading" style="top:7px;font-size: 24px;right: 5px"></i>
        <div class="dropdown-menu w-100 p-0 border-0" :class="show ? 'show' : ''" >
            <div v-if="show_add_new" class="list-group-item list-group-item-action" @click="showModalAdd"  style="cursor: pointer" >
                <div class="d-flex py-2 align-items-center">
                    <i class="fa fa-user-circle-o me-2" style="font-size: 30px;"></i>
                    <div>
                        @{{ add_new_label }}
                    </div>
                </div>
            </div>
            <div class="list-group-item list-group-item-action" @click="change(item)" v-for="(item,index) in items" style="cursor: pointer" v-if="items && items.length">
                <div class="d-flex py-1 align-items-center">
                    <img class="me-2 rounded-circle" v-if="item.avatar_url" width="30px" :src="item.avatar_url">
                    <div>
                        <div>@{{item.display_name}} - #@{{item.id}}</div>
                        <a href="#">@{{item.email}}</a>
                    </div>
                </div>
            </div>
            <div v-if="!loading && loaded && !items.length" class="dropdown-item"><span class="text-danger">@{{not_found}}</span></div>
        </div>
        <div class="modal" tabindex="-1" id="bc_add_customer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__("Add Customer")}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>{{__("First name")}} <span class="text-danger">*</span></label>
                                    <input type="text" required value="" v-model="first_name"  placeholder="{{__("First name")}}" class="form-control">
                                    <div v-if="addNewValidating && !first_name" class="text-danger">{{__("First name is required")}}</div>
                                </div>
                            </div>
                            <div class="col-md-6  mb-3">
                                <div class="form-group">
                                    <label>{{__("Last name")}} <span class="text-danger">*</span></label>
                                    <input type="text" required value="" v-model="last_name" placeholder="{{__("Last name")}}" class="form-control">
                                    <div v-if="addNewValidating && !last_name" class="text-danger">{{__("Last name is required")}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>{{ __('E-mail')}} <span class="text-danger">*</span></label>
                                    <input type="email" required value="" placeholder="{{ __('Email')}}" v-model="email" class="form-control"  >
                                    <div v-if="addNewValidating && !email" class="text-danger">{{__("Email is required")}}</div>
                                    <div v-if="typeof addNewErrors.email !== 'undefined'" class="text-danger">@{{addNewErrors.email.join(', ')}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>{{ __('Phone Number')}} <span class="text-danger">*</span></label>
                                    <input type="text" value="" placeholder="{{ __('Phone')}}" v-model="phone" class="form-control"   >
                                    <div v-if="addNewValidating && !phone" class="text-danger">{{__("Phone is required")}}</div>
                                    <div v-if="typeof addNewErrors.phone !== 'undefined'" class="text-danger">@{{addNewErrors.phone.join(', ')}}</div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>{{ __('Address')}}</label>
                                    <input type="text" value="" placeholder="{{ __('Address')}}" v-model="address" class="form-control"   >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="button" class="btn btn-primary" :disabled="addNewLoading" @click="addNewCustomer">
                            <span v-if="!addNewLoading">{{__("Add new")}}</span>
                            <span v-else>{{__("Saving")}}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script>
    Vue.component('bc-customer-dropdown', {
        template: '#bc_customer_dropdown',
        data:function(){
            return {
                items:[],
                s:"",
                show:false,
                first_load:true,
                timeout:null,
                loading:false,
                loaded:false,
                addModal:null,
                addNewLoading:false,
                addNewValidating:false,
                first_name:'',
                last_name:'',
                email:'',
                phone:'',
                address:'',
                addNewErrors:{}
            }
        },
        props:{
            placeholder: {
                type: String,
                default: '{{__('Search for customer')}}',
            },
            not_found: {
                type: String,
                default: '{{__('No customer found')}}',
            },
            show_add_new: {
                type: Boolean,
                default: true,
            },
            add_new_label: {
                type: String,
                default: '{{__("Add new customer")}}',
            },
        },
        methods: {
            search:function (){
                var me = this;
                this.loading = true;
                var filter = {
                    s:this.s,
                    type_not_in:['grouped','external'],
                    search_type:'join_variation',
                    limit:10
                }
                $.ajax({
                    url:'/customer/getForSelect2',
                    data:filter,
                    success:function (json){
                        if(json.data){
                            me.items = json.data;
                        }
                        me.api_res = json;
                        me.loading = false;
                        me.loaded = true;
                    },
                    error:function (e){
                        me.loading = false;
                        me.loaded = true;
                    }
                })
            },
            openDropdown:function (){
                var me = this;
                me.show = true;
                if(!me.first_load) return;
                me.first_load = false;

                this.search();
            },
            startSearch:function (){
                var me = this;
                if(this.timeout) window.clearTimeout(this.timeout);

                this.timeout = window.setTimeout(function(){
                    me.search();
                },300);
            },
            hideDropdown:function (e){
                this.show = false;
            },
            change:function (item){
                this.$emit('change',item)
                this.hideDropdown();
            },
            showModalAdd:function (){
                if(!this.addModal){
                    this.addModal = new bootstrap.Modal('#bc_add_customer', {
                        keyboard: false
                    })
                }
                this.addModal.show();
            },
            addNewCustomer:function (){
                var me = this;
                if(this.addNewLoading) return;
                if(!this.addNewValidate()){
                    return;
                }
                this.addNewLoading = true;
                this.addNewErrors = {};

                $.ajax({
                    url:'/pos/customer/store',
                    type:'POST',
                    data: {
                        first_name:this.first_name,
                        last_name:this.last_name,
                        email:this.email,
                        phone:this.phone,
                        address:this.address,
                    },
                    success:function(json){
                        me.addNewLoading = false;
                        if(json.data){
                            BCToast.success(i18n.customer_created);
                            me.addModal.hide();
                        }
                        if(!json.status){
                            BCToast.error(json.message);
                        }else{
                            me.change(json.data);
                        }
                    },
                    error:function(e){
                        me.addNewLoading = false;
                        BCToast.showAjaxError(e);
                        if(e.responseJSON && e.responseJSON.errors){
                            me.addNewErrors = e.responseJSON.errors;
                        }
                    }
                })
            },
            addNewValidate:function(){
                this.addNewValidating = true;
                if(!this.first_name || !this.last_name || !this.email || !this.phone) return false;
                return true;
            }
        },
    });
</script>
