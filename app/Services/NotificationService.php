<?php

namespace App\Services;

use App\Mail\GenericNotificationMail;
use App\Models\NotificationLog;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
public function send($userId, $title, $description, $url = null)
{
    NotificationLog::create([
        'user_id' => $userId,
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'seen_by_user' => 0,
    ]);
}


}
