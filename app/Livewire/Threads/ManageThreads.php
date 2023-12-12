<?php

namespace App\Livewire\Threads;

use App\Models\Channel;
use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ManageThreads extends Component
{   use AuthorizesRequests;
    public $threads;
    public $thread;
    #[Validate('required|min:3|max:75', as: 'title')]
    public $newThreadTitle ='';
    #[Validate('required|min:10|max:250', as: 'body')]
    public $newThreadBody ='';
    public $channelId;
    public $channel;
    
    public function mount(Channel $channel)
    {
        if($channel){
            $this->$channel = $channel;
        }
    }
    public function render()
    {
        if($this->channel){
            $this->threads = $this->channel->threads()->latest()->get();
        } else {
            $this->threads = Thread::latest()->get();
        }
        return view('livewire.threads.manage-threads');
    }

    public function addNewThread(){
        $this->validate();
        $newThread = Thread::create([
            'title'=> $this->newThreadTitle,
            'user_id' => Auth::user()->id,
            'channel_id' => $this->channelId,
            'body' => $this->newThreadBody
        ]);
        $this->reset(); 
        $this->redirect($newThread->path());
    }
}
