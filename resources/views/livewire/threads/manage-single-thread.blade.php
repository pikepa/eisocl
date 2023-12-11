<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($thread->title)}}
        </h2>
    </x-slot>
    <!-- main body -->
    <div class="max-w-4xl mx-auto pt-4 ">
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="pl-6 p-4 pb-4 border-b-2 border-b-gray-100 text-gray-700">
                {{ $thread->body }}
                <div class="flex flex-row text-xs">
                    <div class="pt-4 pr-1 font-extralight ">
                        Created by
                    </div>
                    <div class="pt-4 font-extralight  text-blue-700">
                        <a href="#">{{ $thread->creator->name }}</a>
                    </div>
                    <div class="pt-4 pl-1 font-extralight ">
                        - {{ $thread->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Replies -->
    @foreach($thread->replies as $reply)
    <x-threads.reply-item :reply="$reply" />
    @endforeach

    <!-- Add a New Reply -->
    @auth
    <x-containers.reply-body>
        <div class="flex flex-row justify-between ">
            <textarea class="flex-1 mr-4 rounded" type="text" wire:model="newReply"
                placeholder="Enter your reply here !"></textarea>
            <hr>
            <button class="max-h-16 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                wire:click="addThisReply">Save</button>
        </div>
    </x-containers.reply-body>
    @endauth
</div>