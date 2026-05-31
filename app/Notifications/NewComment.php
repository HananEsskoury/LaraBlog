<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Comment;

class NewComment extends Notification
{
    public function __construct(public Comment $comment) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'post_id'    => $this->comment->post_id,
            'post_title' => $this->comment->post->title,
            'commenter'  => $this->comment->user->name,
            'content'    => \Str::limit($this->comment->content, 80),
        ];
    }
}