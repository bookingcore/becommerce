<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PusherNotificationPrivateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $avatar;
    public $link;
    public $idNotification;
    public $userId;

    public function __construct($idNotification, $data, $user)
    {
        if($user->avatar_url){
            $avatar = '<img class="image-responsive" src="'.$user->avatar_url.'" alt="'.$user->display_name.'">';
        }else{
            $avatar = '<span class="avatar-text">'.ucfirst($user->display_name[0]).'</span>';
        }
        $this->avatar  = $avatar;
        $this->link  = @$data['link'];
        $this->idNotification  = $idNotification;
        $this->message  = @$data['message'];
        $this->userId  = $user->id;
    }

    public function broadcastOn()
    {
        return ['user-channel-'.$this->userId];
    }
}
