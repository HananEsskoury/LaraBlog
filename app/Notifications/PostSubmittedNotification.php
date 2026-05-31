<?php
namespace App\Notifications;

use App\Models\Post;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PostSubmittedNotification extends Notification
{
    public function __construct(public Post $post) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => "Nouveau post en attente : \"{$this->post->title}\"",
            'post_id' => $this->post->id,
            'author'  => $this->post->user->name,
            'url'     => route('admin.dashboard'),
        ];
    }
}