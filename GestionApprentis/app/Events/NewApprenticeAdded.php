<?php

namespace App\Events;

use App\Models\apprentis;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewApprenticeAdded implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $apprenti;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(apprentis $apprenti)
    {
        $this->apprenti = $apprenti;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\PrivateChannel|\Illuminate\Broadcasting\PresenceChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('new-apprentice');
    }

    public function broadcastAs()
    {
        return 'new-apprentice-added';
    }
}
