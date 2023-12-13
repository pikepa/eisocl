<?php

namespace App\Livewire\Threads;

use App\Models\User;
use App\Models\Thread;
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
            $this->$channel = $channel;
    }

    public function render()
    {
        if ($this->channel) {
            $this->threads = $this->channel->threads()->latest();
        } else {
            $this->threads = Thread::latest();
        }
        //if request('by'), we should filter by the given username
        if($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();
            $this->threads->where('user_id', $user->id);
        }
        $this->threads = $this->threads->get();
        return view('livewire.threads.manage-threads');
    }

    
}
