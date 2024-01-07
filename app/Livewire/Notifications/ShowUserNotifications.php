<?php

namespace App\Livewire\Notifications;

use Livewire\Component;

class ShowUserNotifications extends Component
{
    public $notifications;

    protected $listeners = ['notificationRead' => 'markAsRead'];

    public function mount()
    {
    }

    public function render()
    {
        $this->notifications = auth()->user()->unreadNotifications;

        return <<<'HTML'
        <div >
            @if($notifications->count() > 0)
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <span> <i class="fa-solid fa-bell"></i> </span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @foreach($notifications as $notification)
                            <x-dropdown-link 
                                wire:click="markAsRead('{{ $notification->id  }}')" 
                                href=" {{ $notification->data['link'] }} ">
                                {{ $notification->data['message'] }}
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
                @endif
        </div>
        HTML;
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
    }
}
