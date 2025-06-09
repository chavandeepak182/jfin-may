<?php

namespace App\Listeners;

use App\Events\LoanStatusUpdated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLoanStatusUpdateNotification
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
    public function handle(LoanStatusUpdated $event)
    {
        $by = ucfirst($event->updatedByRole); // Agent/Admin

        // Notify customer
        $this->notifier->send(
            $event->customerId,
            'Loan Status Updated',
            "Your loan application (#{$event->loanId}) status was updated to '{$event->newStatus}' by {$by}."
        );

        // Optionally, notify Admin or Agent
        $this->notifier->send(
            $event->updatedById,
            'Loan Status Changed',
            "You have updated the loan (#{$event->loanId}) status to '{$event->newStatus}'."
        );
    }
}
