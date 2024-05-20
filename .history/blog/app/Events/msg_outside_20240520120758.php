<?php
namespace App\Events;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class msg_outside implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_id;
    public $message;
    public $fromUserId;
    public $toUserId;
    public $created_at;
    public $user_name;

    public function __construct($message_id,$fromUserId, $toUserId, $message, $created_at)
    {
        $this->message_id = $message_id;
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
        $this->message = $message;
        $this->created_at = $created_at;
        
        
    }

    public function broadcastOn()
    {
        
        return new Channel('chat' . $this->fromUserId);
    }
    
}
