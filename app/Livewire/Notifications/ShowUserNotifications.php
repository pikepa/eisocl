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
        <div >
            <div class='ml-12 mt-4'>
              <h1>Notification count {{ $notifications->count() }}</h1> 
            </div>
            <div class='ml-12 mt-4'>
                @foreach ($notifications as $notification)
                <div>
                     {{ $notification->data['message'] }}
                </div>
                @endforeach
            </div>
        </div>
        HTML;
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
    }
}
