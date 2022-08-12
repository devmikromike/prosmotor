<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use lluminate\Auth\Events\Login;

class LoginEvent extends Login
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $remember;
     public $user;
     public $guard;

     public function __construct($guard, $user, $remember)
     {
       $this->user = $user;
       $this->guard = $guard;
       $this->remember = $remember;
     }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
