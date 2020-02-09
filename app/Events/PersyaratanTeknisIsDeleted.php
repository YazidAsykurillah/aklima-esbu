<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\PersyaratanTeknis;
class PersyaratanTeknisIsDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $persyaratan_teknis;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PersyaratanTeknis $persyaratan_teknis)
    {
        $this->persyaratan_teknis = $persyaratan_teknis;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
