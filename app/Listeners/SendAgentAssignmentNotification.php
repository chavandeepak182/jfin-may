<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


use App\Events\AgentAssigned;
use App\Services\NotificationService;

class SendAgentAssignmentNotification
{

    protected $notifier;
    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * Handle the event.
     */
    public function handle(AgentAssigned $event)
    {

        $loanId = $event->loanId;
        $agentName = $event->agentName;
        
        $this->notifier->send($event->adminId, 'Agent Assigned', 'You assigned ' . $agentName . ' to Loan #' . $loanId);

        if ($event->agentId) {
            $this->notifier->send($event->agentId, 'New Loan Assigned', 'You have been assigned a new loan application (#' . $loanId . ').');
        }

        $this->notifier->send($event->customerId, 'Agent Assigned', 'An agent (' . $agentName . ') has been assigned to your loan application (#' . $loanId . ').');
    }
}
