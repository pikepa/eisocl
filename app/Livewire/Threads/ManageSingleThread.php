<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;

class ManageSingleThread extends Component
{
    public $thread;
    public function mount($thread)
    {
        $this->thread = Thread::find($thread);
    }
    public function render()
    {
        return view('livewire.threads.manage-single-thread');
    }
}
