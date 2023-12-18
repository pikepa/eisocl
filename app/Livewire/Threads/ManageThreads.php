<?php

namespace App\Livewire\Threads;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ManageThreads extends Component
{
    use AuthorizesRequests;

    public $threads;

    public $thread;

    public Channel $channel;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render(ThreadFilters $filters)
    {
        $threads = $this->getThreads($this->channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('livewire.threads.manage-threads');
    }

    public function getThreads($channel, $filters)
    {
        $this->threads = Thread::with('channel', 'creator')->latest()->filter($filters);
        if ($this->channel->exists) {
            $this->threads->where('channel_id', $this->channel->id);
        }
        //  dd($this->threads->toSql());

        $this->threads = $this->threads->get();
    }
}
