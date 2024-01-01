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

    #[Validate('required|min:3|max:2000', as: 'body')]
    public $newReply;

    public function mount($thread)
    {
        $this->thread = Thread::find($thread);
    }

    public function addThisReply()
    {
        $this->validate();
        $this->thread->replies()->create([
            'body' => $this->newReply,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('newReply');
    }

    public function deleteThisReply(Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->delete();

        return back();
    }

    public function render()
    {
        return view('livewire.threads.manage-single-thread', [
            'thread' => $this->thread,
            'replies' => $this->thread->replies()->paginate(10),
        ]);
    }

    public function addFavorite(Reply $reply)
    {
        if (auth()->check()) {
            return $reply->favorite();
        } else {
            return redirect()->to('/login');
        }
    }
}
