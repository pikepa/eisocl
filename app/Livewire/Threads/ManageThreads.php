<?php

namespace App\Livewire\Threads;

use App\Models\User;
use App\Models\Thread;
use App\Filters\ThreadFilters;
use App\Models\Channel;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageThreads extends Component
{
    use AuthorizesRequests;

    public $threads;
    public $thread;
    public $channel;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render(ThreadFilters $filters)
    {
        $this->threads=Thread::latest()->filter($filters);
        if ($this->channel->exists) {
            $this->threads->where('channel_id', $this->channel->id);
        }
        $this->threads=$this->threads->get();
        return view('livewire.threads.manage-threads');
    }
}
