<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Customer Register')}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('Customer Register')}}</strong></div>
            <div class="panel-body">
                @if(is_default_lang())

                    <div class="form-group">
                        <label>{{__('Customer Role')}}</label>
                        <div class="form-controls">
                            <select name="customer_role" class="form-control">
                                @foreach(\Modules\User\Models\Role::all() as $role)
                                <option value="{{$role->id}}" {{setting_item('customer_role') == $role->id ? 'selected': ''  }}>{{ucfirst($role->name)}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <p>{{__('You can edit on main lang.')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>

