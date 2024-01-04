<?php

namespace App\Livewire\Threads;

use Livewire\Component;

class SubscribeButton extends Component
{
    public $thread;

    public $buttonTitle = 'Subscribe';

    public $active = 'false';

    public function mount($thread)
    {
        $this->thread = $thread;
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
                    class="@if( $active == false ) bg-green-600 @else bg-blue-600 @endif 
                      font-semibold inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 rounded text-white  focus:outline-none transition ease-in-out duration-150">
                    {{ $buttonTitle }}
                </button>
        </div>
        HTML;
    }
}
