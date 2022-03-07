<?php


namespace Modules\User\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'avatar_url'=>$this->avatar_url,
            'display_name'=>$this->display_name,
            'billing'=>$this->when(request('need_address'),$this->billing_address),
            'shipping'=>$this->when(request('need_address'),$this->shipping_address),
            'text'=>$this->when(request('_type') == 'query',$this->display_name . ' (#' . $this->id . ')')
        ];
    }
}
