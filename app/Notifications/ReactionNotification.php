<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Reaction;

class ReactionNotification extends Notification
{
    public function __construct(public Reaction $reaction) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $emojis = [
            'like'  => '👍',
            'love'  => '❤️',
            'haha'  => '😂',
            'wow'   => '😮',
            'sad'   => '😢',
            'angry' => '😡',
        ];

        return [
            'post_id'       => $this->reaction->post_id,
            'post_title'    => $this->reaction->post->title,
            'reactor_name'  => $this->reaction->user->name,
            'reaction_type' => $this->reaction->type,
            'emoji'         => $emojis[$this->reaction->type] ?? '👍',
        ];
    }
}