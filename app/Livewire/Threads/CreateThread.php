<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateThread extends Component
{
    #[Validate('required|min:3|max:75', as: 'title')]
    public $newThreadTitle = '';

    #[Validate('required|min:10|max:2500', as: 'body')]
    public $newThreadBody = '';

    #[Validate('required', as: 'channel_id')]
    public $channelId = '';

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
        $this->redirect($newThread->path());
    }
}
