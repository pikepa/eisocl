<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class ManageSingleThread extends Component
{
    public $thread;
    #[Validate('required|min:3|max:250', as: 'body')]
    public $newReply;

    public function mount($thread)
    {
        $this->thread = Thread::find($thread);
    }
    public function addThisReply(){
        $this->validate();
        $this->thread->replies()->create([
            'body'=> $this->newReply,
            'user_id' => Auth::user()->id,
        ]);
        $this->reset('newReply'); 
    }
    public function render()
    {
        return view('livewire.threads.manage-single-thread');
    }
}
