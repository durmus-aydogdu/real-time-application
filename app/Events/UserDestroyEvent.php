<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserDestroyEvent implements ShouldBroadcast
{
    use SerializesModels;

    protected $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('UserDestroy');
    }

    public function broadcastWith()
    {
        return [ 'id' => $this->userId];
    }
}
