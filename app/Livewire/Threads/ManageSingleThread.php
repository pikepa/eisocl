<?php

namespace App\Livewire\Threads;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageSingleThread extends Component
{
    public $thread;

    public $replyEdit;

    #[Validate('required|min:3|max:2000', as: 'body')]
    public $newReply;

    public function mount($thread)
    {
        $this->thread = Thread::find($thread);
    }

    public function editReply(Reply $reply)
    {
        $this->authorize('update', $reply);
        $this->replyEdit = $reply->body;
    }

    public function saveEdit(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->body = $this->replyEdit;
        $reply->update();
    }

    public function addThisReply()
    {
        $this->validate();
        $this->thread->replies()->create([
            'body' => $this->newReply,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('newReply');
        $this->thread->refresh();
    }

    public function deleteThisReply(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();
        $this->thread->refresh();

        return back();
    }

    public function render()
    {
        return view('livewire.threads.manage-single-thread', [
            'thread' => $this->thread,
            'replies' => $this->thread->replies()->paginate(10),
        ]);
    }

    public function toggleFavorite(Reply $reply)
    {
        if (auth()->check()) {
            if ($reply->isFavorited()) {
                return $reply->unfavorite();
            } else {
                return $reply->favorite();
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
