<?php


namespace Modules\User\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserPlan extends BaseModel
{
    protected $table  = 'user_plan';

    protected $casts = [
        'end_date'=>'datetime',
        'plan_data'=>'array'
    ];

    public function isValid(): Attribute
    {
        return Attribute::make(
            get:function($value){
                if(!$this->end_date) return true;

                return $this->end_date->timestamp > time();
            }
        );
    }

    public function plan(){
        return $this->belongsTo(Plan::class,'plan_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'id');
    }

    public function used(): Attribute
    {
        return Attribute::make(
            get:function($value){
                switch ($this->user->role->code ?? ''){
                    case "employer":
                        if(!$this->user->company) return 0;
                        return $this->user->company->jobs()->count('id');
                    break;
                    case "candidate";
                        return $this->user->gigs()->count('id');
                    break;
                }
            }
        );
    }
}
