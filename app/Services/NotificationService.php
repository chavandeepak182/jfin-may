<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoanNotificationMail;

class NotificationService
{public static function send($users, $title, $message)
{
    // ✅ Convert single user to array
    if (!is_array($users)) {
        $users = [$users];
    }

    foreach ($users as $user) {

        // If user_id passed instead of object
        if (is_numeric($user)) {
            $user = \App\Models\User::find($user);
        }

        if (!$user) continue;

        if ($user->email_id) {

            \Log::info('Sending Email', [
                'user_id' => $user->id,
                'email' => $user->email_id
            ]);

            \Mail::to($user->email_id)
                ->send(new \App\Mail\LoanNotificationMail($title, $message));
        }
    }
}
}