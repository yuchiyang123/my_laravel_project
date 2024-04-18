<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Arr;

class PostGoodCountUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $article_id;
    public $goodcount;

    public function __construct($article_id, $goodcount)
    {
        $this->article_id = $article_id;
        $this->goodcount = $goodcount;
        
    }

    public function broadcastOn()
    {
        return new Channel('article_id_'. $this->article_id);
    }

    public function broadcastWith()
    {
        return [
            'article_id' => $this->article_id,
            'goodcount' => $this->goodcount,
        ];
    }
    
}
