<?php

namespace App\Services;

use App\Models\SystemNotification;
use App\Models\User;

class NotificationService
{
    public function sendToUser(User $user, string $title, string $message, string $type = 'info', array $data = []): SystemNotification
    {
        return SystemNotification::query()->create([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'data' => $data ?: null,
        ]);
    }

    /**
     * @param  iterable<User>  $users
     * @return array<int, SystemNotification>
     */
    public function sendToUsers(iterable $users, string $title, string $message, string $type = 'info', array $data = []): array
    {
        $created = [];

        foreach ($this->uniqueUsers($users) as $user) {
            $created[] = $this->sendToUser($user, $title, $message, $type, $data);
        }

        return $created;
    }

    /**
     * @param  iterable<User>  $users
     * @return array<int, User>
     */
    private function uniqueUsers(iterable $users): array
    {
        $unique = [];

        foreach ($users as $user) {
            if (! $user instanceof User) {
                continue;
            }

            $unique[$user->id] = $user;
        }

        return array_values($unique);
    }
}
