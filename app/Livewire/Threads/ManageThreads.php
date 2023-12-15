<?php

namespace App\Livewire\Threads;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ManageThreads extends Component
{
    use AuthorizesRequests;

    public $threads;

    public $thread;

    public $channel;

    public function mount(Channel $channel)
    {
        $this->$channel = $channel;
    }

    public function render()
    {
        $this->getThreads();

        return view('livewire.threads.manage-threads');
    }

    protected function getThreads()
    {
        if ($this->channel) {
            $this->threads = $this->channel->threads()->latest();
        } else {
            $this->threads = Thread::latest();
        }
        //if request('by'), we should filter by the given username
        if ($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();
            $this->threads->where('user_id', $user->id);
        }
        $this->threads = $this->threads->get();
    }
}
