<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Post;

class NewPostFromFollowedAuthor extends Notification
{
    public function __construct(public Post $post) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'post_id'     => $this->post->id,
            'post_title'  => $this->post->title,
            'author_name' => $this->post->user->name,
            'author_id'   => $this->post->user->id,
        ];
    }
}