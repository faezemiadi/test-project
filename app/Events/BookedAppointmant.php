<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookedAppointmant
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;

    public $consultant;

    public $detail;

    /**
     * Create a new event instance.
     */
    public function __construct($client,$consultant,$detail)
    {
        $this->client = $client;

        $this->consultant = $consultant;

        $this->detail = $detail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
