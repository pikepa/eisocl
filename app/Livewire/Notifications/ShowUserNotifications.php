<?php

namespace App\Livewire\Notifications;

use Livewire\Component;

class ShowUserNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            I'm here
            {{ $notifications->count() }}
            @foreach ($notifications as $notification)
                {{ $notification->id }}
            @endforeach
        </div>
        HTML;
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
    }
}
