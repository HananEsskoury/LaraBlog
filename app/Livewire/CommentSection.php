<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentSection extends Component
{
    public $postId;
    public $content;

    public function addComment(){
        $this->validate([
            'content' => 'required|min:3'
        ]);

        Comment::create([
            'post_id' => $this->postId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->content = '';
    }

    public function render(){
        return view('livewire.comment-section', [
            'comments' => Comment::where('post_id', $this->postId)
                                 ->with('user')
                                 ->latest()
                                 ->get()
        ]);
    }
}