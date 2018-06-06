<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserUpdateEvent implements ShouldBroadcast
{
    use SerializesModels;

    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('UserUpdate');
    }

    public function broadcastWith()
    {
        return [ 'id' => $this->user['id'],
            'name' => $this->user['name'],
            'email' => $this->user['email']
        ];
    }
}
