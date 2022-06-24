<?php


namespace Modules\Vendor\Events;


use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Vendor\Models\VendorRequest;

class UpgradeRequestCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $vendor_request;

    public function __construct(User $user,VendorRequest $vendor_request){
        $this->user = $user;
        $this->vendor_request = $vendor_request;
    }
}
