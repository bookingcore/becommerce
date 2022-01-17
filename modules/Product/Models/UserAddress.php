<?php


namespace Modules\Product\Models;


use App\BaseModel;

class UserAddress extends BaseModel
{

    protected $table = 'user_address';
    protected $fillable =[
        'first_name',
        'last_name',
        'company',
        'address',
        'address2',
        'city',
        'state',
        'postcode',
        'country',
        'email',
        'phone',
        'type',
    ];

    public function getHtmlAttribute(){
        $data = [
            $this->first_name.' '.$this->last_name,
            $this->company,
            $this->address,
            $this->address2,
            $this->address2,
            $this->city.', '.$this->state.' '.$this->post_code,
            get_country_name($this->country)
        ];
        $data = array_filter($data);
        return implode("<br>",$data);
    }
}
