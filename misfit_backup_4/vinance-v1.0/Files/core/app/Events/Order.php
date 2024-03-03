<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Order implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $pairSym;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $pairSym)
    {
        $this->order   = $order;
        $this->pairSym = $pairSym;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('order-placed-to-' . $this->pairSym);
    }

    public function broadcastAs()
    {
        return 'order-placed-to-' . $this->pairSym;
    }
}
