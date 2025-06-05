<?php

namespace App\Services;

use App\Models\NotificationLog;

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
    }
}
