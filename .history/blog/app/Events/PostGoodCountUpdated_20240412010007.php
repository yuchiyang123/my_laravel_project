<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostGoodCountUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mjoinId;
    public $count;

    public function __construct($mjoinId, $count)
    {
        $this->mjoinId = $mjoinId;
        $this->count = $count;
    }

    public function broadcastOn()
    {
        return new Channel('mjoin_post_' . $this->mjoinId);
    }

    public function broadcastAs()
    {
        return 'postGoodCountUpdated';
    }
}