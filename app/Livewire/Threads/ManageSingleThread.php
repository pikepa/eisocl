<?php

namespace App\Livewire\Threads;

use App\Models\Reply;
use App\Models\Thread;
use App\Rules\Spamfree;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageSingleThread extends Component
{
    public $thread;

    public $exceptionError;

    public $replyEdit;

    public $newReply;

    public $spam;

    public function rules()
    {
        return [
            'newReply' => ['required', 'min:5', 'max:2000', new Spamfree],
            'replyEdit' => ['required', 'min:5', 'max:2000', new Spamfree],
        ];
    }

    public function messages()
    {
        return [
            'newReply.required' => 'The :attribute is missing.',
            'newReply.min' => 'The :attribute is too short (Min 5 char).',
            'newReply.max' => 'The :attribute is too long (Max 2000).',
            'replyEdit.required' => 'The :attribute is missing.',
            'replyEdit.min' => 'The :attribute is too short (Min 5 char).',
            'replyEdit.max' => 'The :attribute is too long (Max 2000).',
        ];
    }

    public function validationAttributes()
    {
        return [
            'newReply' => 'reply',
            'replyEdit' => 'reply',
        ];
    }

    public function mount($thread)
    {
        $this->thread = Thread::find($thread);
    }

    public function addThisReply()
    {
        $this->authorize('create', new Reply);
        $this->validateOnly('newReply');

        return $this->thread->addreply([
            'body' => $this->newReply,
            'user_id' => Auth::user()->id,
        ])->load('owner');

        $this->reset('newReply');
        $this->dispatch('notify', 'A new reply was created');

        $this->thread->refresh();
    }

    public function editReply(Reply $reply)
    {
        $this->authorize('update', $reply);
        $this->replyEdit = $reply->body;
    }

    public function saveEdit(Reply $reply)
    {
        $this->authorize('update', $reply);

        $this->validateOnly('replyEdit');
        $reply->body = $this->replyEdit;
        $reply->update();
        $this->dispatch('notify', 'The reply edit was successful.');

        $this->reset('replyEdit');
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
