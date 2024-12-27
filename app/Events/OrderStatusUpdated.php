<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $notifyMessage;
    public $id;
    public $order_id;
    public $order_status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $notifyMessage, int $id, int $order_id, string $order_status)
    {
        $this->notifyMessage = $notifyMessage;
        $this->id = $id;
        $this->order_id = $order_id;
        $this->order_status = $order_status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn(): Channel
    {
        return new Channel('orders');
    }
}
