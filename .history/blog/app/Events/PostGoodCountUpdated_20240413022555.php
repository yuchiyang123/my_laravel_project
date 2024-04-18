<?php

namespace App\Events;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Arr;

class PostGoodCountUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mjoinId;
    public $goodcount;

    public function __construct($mjoinId, $goodcount)
    {
        $this->mjoinId = $mjoinId;
        $this->goodcount = $goodcount;
        \Log::info('1Event broadcasted: mjoinId - ' . $this->mjoinId . ', goodcount - ' . $this->goodcount);
        
    }

    public function broadcastOn()
    {
        return new Channel(sprintf('mjoin_post_%s', $this->mjoinId));
    }

    public function broadcastAs(): string
    {
        return 'PostGoodCountUpdated';
    }

    
}
