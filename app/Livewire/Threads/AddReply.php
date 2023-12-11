<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;

class AddReply extends Component
{
    public Thread $thread;
    public $body;
    public function mount(Thread $thread)
    {
        $this->thread = $thread;
    }
    public function render()
    {
        return view('livewire.threads.add-reply');
    }
    
    public function saveReply($body){
        $this->thread->addReply([
            'body' => $body,
            'user_id' => Auth::user->id,
        ])

    }

}
