<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class LoanStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loanId;
    public $updatedById;
    public $updatedByRole; // 'admin' or 'agent'
    public $newStatus;
    public $customerId;

    /**
     * Create a new event instance.
     */
    public function __construct($loanId, $updatedById, $updatedByRole, $newStatus, $customerId)
    {
        $this->loanId = $loanId;
        $this->updatedById = $updatedById;
        $this->updatedByRole = $updatedByRole;
        $this->newStatus = $newStatus;
        $this->customerId = $customerId;
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
