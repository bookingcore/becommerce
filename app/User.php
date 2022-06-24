<?php

    namespace App;

    use App\Traits\HasMeta;
    use App\Traits\HasSlug;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Support\Facades\Mail;
    use Laravel\Sanctum\HasApiTokens;
    use Modules\Product\Traits\HasAddress;
    use Modules\Review\Models\Review;
    use Modules\User\Emails\ResetPasswordToken;
    use Modules\User\Models\Role;
    use Modules\User\Models\UserPlan;
    use Modules\User\Models\UserWishList;
    use Modules\User\Traits\HasRoles;
    use Modules\Vendor\Models\VendorRequest;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Modules\Vendor\Traits\HasPayout;

    class User extends Authenticatable implements MustVerifyEmail
    {
        use SoftDeletes;
        use HasApiTokens, HasFactory, Notifiable;
        use HasRoles;
        use HasAddress;
        use HasPayout;
        use HasSlug;
        use HasMeta;

        protected $meta_parent_key = 'user_id';
        protected $metaClass = UserMeta::class;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $table = 'users';

        protected $fillable = [
            'first_name',
            'last_name',
            'email',
            'email_verified_at',
            'password',
            'phone',
            'birthday',
            'last_login_at',
            'avatar_id',
            'bio',
            'business_name',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        protected $attributes = [
            'status'=>'publish',
            'commission_type'=>'default',
        ];

        protected $slugField = 'username';
        protected $slugFromField = 'display_name';

        public function batchInsertMeta($metaArrs = [])
        {
            if (!empty($metaArrs)) {
                foreach ($metaArrs as $key => $val) {
                    $this->addMeta($key, $val, true);
                }
            }
        }

        protected function nameOrEmail(): Attribute
        {
            return Attribute::make(
              get:function($value){
                    if ($this->first_name) return $this->first_name;

                    return $this->email;
                }
            );
        }

        public static function getUserBySocialId($provider, $socialId)
        {
            return parent::query()->select('users.*')->join('user_meta as m', 'm.user_id', 'users.id')
                ->where('m.name', 'social_' . $provider . '_id')
                ->where('m.val', $socialId)->first();
        }

        public function getAvatarUrl()
        {
            if (!empty($this->avatar_id)) {
                return get_file_url($this->avatar_id, 'thumb');
            }
            if(!empty($meta_avatar = $this->getMeta("social_meta_avatar",false))) {
                return $meta_avatar;
            }
            return asset('images/avatar.png');
        }
        public function getUserAvatar($default_type = 'image'){
            $display_name = $this->display_name;
            if (!empty($this->avatar_id)) {
                return '<img src="'.get_file_url($this->avatar_id, 'thumb').'" alt="'.$display_name.'">';
            }
            if(!empty($meta_avatar = $this->getMeta("social_meta_avatar",false))) {
                return '<img src="'.$meta_avatar.'" alt="'.$display_name.'">';
            }
            if($default_type == 'text'){
                return '<span class="user-text">'.trim($display_name)[0].'</span>';
            }
            return '<img src="'.asset('images/avatar.png').'" alt="'.$display_name.'">';
        }


        protected function avatarUrl(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    return $this->getAvatarUrl();
                }
            );

        }



        protected function displayName(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    $name = '';
                    if (!empty($this->first_name) or !empty($this->last_name)) {
                        $name = implode(' ', [$this->first_name, $this->last_name]);
                    }
                    if( !empty($this->business_name) ){
                        $name  = $this->business_name;
                    }
                    return trim($name);
                }
            );

        }

        public function sendPasswordResetNotification($token)
        {
            Mail::to($this->email)->send(new ResetPasswordToken($token,$this));
        }

        protected function reviewCount(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    return Review::query()->where('vendor_id',$this->id)->where('status','approved')->count('id');
                }
            );

        }

        public function vendorRequest(){
            return $this->hasOne(VendorRequest::class);
        }



        protected function verificationFields(): Attribute
        {
            return Attribute::make(
                get:function ($value){
                    $all = get_all_verify_fields();
                    $role_id = $this->role_id;
                    $res = [];
                    foreach ($all as $id=>$field)
                    {
                        if(!empty($field['roles']) and is_array($field['roles']) and in_array($role_id,$field['roles']))
                        {
                            $field['id'] = $id;
                            $field['field_id'] = 'verify_data_'.$id;
                            $field['is_verified'] = $this->isVerifiedField($id);
                            $field['data'] = old('verify_data_'.$id,$this->getVerifyData($id));

                            switch ($field['type'])
                            {
                                case "multi_files":
                                    $field['data'] = json_decode($field['data'],true);
                                    if(!empty($field['data']))
                                    {
                                        foreach ($field['data'] as $k=>$v){
                                            if(!is_array($v)){
                                                $field['data'][$k] = json_decode($v,true);
                                            }
                                        }
                                    }
                                break;
                            }
                            $res[$id] = $field;
                        }
                    }

                    return \Illuminate\Support\Arr::sort($res, function ($value) {
                        return $value['order'] ?? 0;
                    });
                }
            );

        }

        public function isVerifiedField($field_id){
            return (bool) $this->getMeta('is_verified_'.$field_id);
        }
        public function getVerifyData($field_id){
            return $this->getMeta('verify_data_'.$field_id);
        }

        public static function countVerifyRequest(){
            return parent::query()->whereIn('verify_submit_status',['new','partial'])->count(['id']);
        }

        public static function countUpgradeRequest(){
            return parent::query()->whereIn('verify_submit_status',['new','partial'])->count(['id']);
        }

        /**
         * Send the email verification notification.
         *
         * @return void
         */
        public function sendEmailVerificationNotification()
        {
            $this->notify(new \App\Notifications\VerifyEmail());
        }

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }
        /**
         * Return a key value array, containing any custom claims to be added to the JWT.
         *
         * @return array
         */
        public function getJWTCustomClaims()
        {
            return [];
        }

        public function creditPaymentUpdate($payment){

            if($payment->status == 'completed'){
                $this->deposit($payment->getMeta('credit'),$payment->getMeta());
            }
        }


        protected function name(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    return $this->first_name.' '.$this->last_name;
                }
            );

        }

        public function department(){
            return $this->belongsTo(Department::class, 'department_id');
        }

        public function fillByAttr($attributes , $input)
        {
            if(!empty($attributes)){
                foreach ( $attributes as $item ){
                    $this->$item = isset($input[$item]) ? ($input[$item]) : null;
                }
            }
        }

        public function getWishlistCountAttribute(){
            return UserWishList::query()->where('user_id',$this->id)->count('id');
        }

        public function user_plan(){
            return $this->hasOne(UserPlan::class,'id');
        }

        public function checkJobPlan(){
            if(!setting_item('job_require_plan')) return true;

            $user_plan = $this->user_plan;

            if(!$user_plan) return false;

            if($user_plan->end_date->timestamp <= time()) return false;

            if(!$this->company) return false;

            $count_service = $this->company->jobs()->count('id');

            if($user_plan->max_service and $count_service >= $user_plan->max_service){
                return false;
            }
            return true;
        }

        public function applyPlan(Plan $plan,$price,$is_annual = false){
            $user_plan = $this->user_plan;
            if(!$user_plan){
                $user_plan = new UserPlan();
                $user_plan->id = $this->id;
            }

            if($is_annual){
                $end_date = strtotime('+ 1 year');
            }else{
                $end_date = strtotime('+ '.$plan->duration.' '.$plan->duration_type);
            }
            $plan_data = $plan->toArray();
            $plan_data['is_annual'] = $is_annual;
            $data = [
                'plan_id'=>$plan->id,
                'price'=>$price,
                'start_date'=>date('Y-m-d H:i:s'),
                'end_date'=>date('Y-m-d H:i:s',$end_date),
                'max_service'=>$plan->max_service,
                'plan_data'=>$plan_data,
                'status'=>1
            ];
            $user_plan->fillByAttr(array_keys($data),$data);
            $user_plan->save();
        }


        protected function statusTBadge(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    return get_status_badge($this->status);
                }
            );

        }

        protected function statusText(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    return get_status_text($this->status);
                }
            );

        }


        protected function permissions(): Attribute
        {
            return Attribute::make(
                get:function($value){
                    $role = $this->role;
                    if(!$role) return [];

                    return $role->permissions->pluck('permission')->all();
                }
            );

        }

        public function getStoreUrl(){
            return route('store',['slug'=>$this->username ? $this->username : $this->id]);
        }

        public function role(){
            return $this->belongsTo(Role::class,'role_id');
        }

    }

