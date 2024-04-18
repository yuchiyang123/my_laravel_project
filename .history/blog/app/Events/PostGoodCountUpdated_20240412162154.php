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
    public $goodcount;

    public function __construct($mjoinId, $goodcount)
    {
        $this->mjoinId = $mjoinId;
        $this->goodcount = $goodcount;
        \Log::info('Event broadcasted: mjoinId - ' . $this->mjoinId . ', goodcount - ' . $this->goodcount);
    }

    public function broadcastOn()
    {
        return new Channel('mjoin_post_' . $this->mjoinId);
    }

    public function broadcastAs()
    {
        return 'PostGoodCountUpdated';
    }
}
