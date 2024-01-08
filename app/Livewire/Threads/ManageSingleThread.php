<?php

namespace App\Livewire\Threads;

use App\Inspections\Spam;
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

    public $spam;

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
        $spam = new Spam;
        $spam->detect($this->replyEdit);
        $reply->body = $this->replyEdit;
        $reply->update();
    }

    public function addThisReply()
    {
        $this->validateReply();

        $reply = [
            'body' => $this->newReply,
            'user_id' => Auth::user()->id,
        ];
        $this->thread->addReply($reply);
        $this->reset('newReply');
        $this->thread->refresh();
    }

    protected function validateReply()
    {
        $this->validate();
        resolve(Spam::class)->detect($this->newReply);
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
        //record that the user visited this page.
        if (auth()->check()) {
            auth()->user()->read($this->thread);
        }

        return view('livewire.threads.manage-single-thread', [
            'thread' => $this->thread,
            'replies' => $this->thread->replies()->get(),
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
