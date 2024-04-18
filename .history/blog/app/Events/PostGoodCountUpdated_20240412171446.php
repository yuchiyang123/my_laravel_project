<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
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

    public function broadcastOn(): Channel
    {
        return new Channel('mjoin_post_' . $this->mjoinId);
    }

    public function broadcastAs(): string
    {
        return 'PostGoodCountUpdated';
    }

    public function broadcastWith(): array
    {
        return [
            'goodcount' => $this->goodcount,
        ];
    }
}