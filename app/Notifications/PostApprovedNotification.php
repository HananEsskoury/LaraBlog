<?php
namespace App\Notifications;

use App\Models\Post;
use Illuminate\Notifications\Notification;

class PostApprovedNotification extends Notification
{
    public function __construct(public Post $post) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => "Votre post \"{$this->post->title}\" a été approuvé et publié !",
            'post_id' => $this->post->id,
            'url'     => route('fullpost', $this->post->id),
        ];
    }
}