<?php

namespace App\Livewire\Threads;

use Livewire\Component;

class SubscribeButton extends Component
{
    public $thread;

    public $buttonTitle = 'Subscribe';

    public $active = false;

    public function mount($thread)
    {
        $this->thread = $thread;
        if ($this->thread->IsSubscribedTo) {
            $this->buttonTitle = 'Unsubscribe';
            $this->active = true;
        }
    }

    public function subscribe()
    {
        if (! $this->thread->IsSubscribedTo) {
            $this->thread->subscribe(auth()->user()->id);
            $this->buttonTitle = 'Unsubscribe';
            $this->active = true;

            return $this;
        }
        $this->thread->unsubscribe(auth()->user()->id);
        $this->buttonTitle = 'Subscribe';
        $this->active = false;
    }

    public function render()
    {
        return <<<'HTML'
        <div class='mt-4'>
        <button 
                    wire:click="subscribe({{ $thread->id }})" 
                    class="bg-transparent text-blue-700 font-semibold py-2 px-4 border border-blue-500  rounded">
                    {{ $buttonTitle }}
                </button> 
        </div>
        HTML;
    }
}
