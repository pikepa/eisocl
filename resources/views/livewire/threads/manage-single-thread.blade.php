<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($thread->title)}}
        </h2>
    </x-slot>
    <!-- main body -->
    <div class="flex flex-row space-x-2">
        <div class="w-2/3 ml-4 pt-4 ">
            <div class=" bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" pl-6 p-4 pb-4 border-b-2 border-b-gray-100 text-gray-700">
                    {{ $thread->body }}

                </div>
            </div>
            <h1 class="pl-6 pt-2  font-semibold">
                Comments
            </h1>
            <!-- Replies -->
            @foreach($replies as $reply)
            <x-threads.reply-item :reply="$reply" />
            @endforeach
            <div class="p-4">
                {{ $replies->links() }}
            </div>
            @guest
            <div class="mx-auto text-center">
                <h1>*** In order to reply, please go to Dashboard then login / register ***</h1>
            </div>
            @endguest
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
                @if($errors->has('newReply'))
                <span class="text-sm text-red-600 font-semibold">{{ $errors->first('newReply') }}</span>
                @endif
            </x-containers.reply-body>
            @endauth
        </div>
        <div class="w-1/3">
            <div class="mt-4 m-2 bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" pl-6 p-4 pb-4 border-b-2 border-b-gray-100 text-gray-700">
                    <p> This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <span class="text-blue-500"><a href="/activities/{{ $thread->creator->id }}">{{
                                $thread->creator->name }}</a></span>
                        , and currently has {{ $thread->replies_count }} {{
                        Str::plural('comment',$thread->replies_count) }}
                    </p>
                    @auth
                    <livewire:threads.subscribe-button :thread='$thread' />
                    @endauth
                </div>
            </div>

        </div>
    </div>



</div>