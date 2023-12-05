<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;

class ManageThreads extends Component
{
    public $threads;
    public function render()
    {
        $this->threads= Thread::get();
        return view('livewire.threads.manage-threads');
    }
}
