<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgentAssigned
{
    use Dispatchable, SerializesModels;

    public $adminId;
    public $agentId;
    public $customerId;
    public $loanId;
    public $loanReferenceId;
    public $agentName;

    /**
     * Create a new event instance.
     */
    public function __construct(
        $adminId,
        $agentId,
        $customerId,
        $loanId,
        $loanReferenceId,
        $agentName
    ) {
        $this->adminId = $adminId;
        $this->agentId = $agentId;
        $this->customerId = $customerId;
        $this->loanId = $loanId;
        $this->loanReferenceId = $loanReferenceId;
        $this->agentName = $agentName;
    }
}
