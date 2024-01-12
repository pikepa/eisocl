<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use App\Rules\Spamfree;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateThread extends Component
{
    public $newThreadTitle = '';

    public $newThreadBody = '';

    public $channelId = '';

    public function rules()
    {
        return [
            'newThreadTitle' => ['required', 'min:5', 'max:75', new Spamfree],
            'newThreadBody' => ['required', 'min:5', 'max:2500', new Spamfree],
            'channelId' => ['required'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'channelId' => 'channel',
        ];
    }

    public function render()
    {
        return view('livewire.threads.create-thread');
    }

    public function addNewThread()
    {
        $this->validate();

        $newThread = Thread::create([
            'title' => $this->newThreadTitle,
            'user_id' => Auth::user()->id,
            'channel_id' => $this->channelId,
            'body' => $this->newThreadBody,
        ]);
        $this->reset();
        $this->dispatch('notify', 'A new thread was created');
        //  $this->redirect('/threads');
    }
}
