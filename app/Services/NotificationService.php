<?php

namespace App\Services;

use App\Mail\GenericNotificationMail;
use App\Models\NotificationLog;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function send($userId, $title, $description)
    {
        NotificationLog::create([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'seen_by_user' => false,
        ]);

        $user = User::find($userId);
        if ($user && $user->email) {
            Mail::to($user->email)->send(new GenericNotificationMail($title, $description));
        }
    }
}
