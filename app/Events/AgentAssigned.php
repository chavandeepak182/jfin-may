<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Loan;


class AgentAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $adminId;
    public $agentId;
    public $customerId;
    public $loanId;

    /**
     * Create a new event instance.
     */
    
    public function __construct($adminId, $agentId, $customerId, $loanId)
    {
        $this->adminId = $adminId;
        $this->agentId = $agentId;
        $this->customerId = $customerId;
        $this->loanId = $loanId;
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
