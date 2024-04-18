<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class click_good implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $reply_id;
    public $great;

    public function __construct($reply_id, $great)
    {
        $this->reply_id = $reply_id;
        $this->great = $great;
    }

    public function broadcastOn()
    {
        return new Channel('post.' . $this->reply_id);
    }
}
