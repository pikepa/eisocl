<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <x-containers.main-body>
        @foreach($threads as $thread)
        <x-threads.thread-item :thread="$thread" />
        @endforeach
    </x-containers.main-body>
    <!-- Add a New Reply -->
    @auth
    <x-containers.main-body>
        <div class="py-6 px-4 border-b-2 border-b-gray-100 text-gray-900">
            <div class="flex flex-row justify-between ">
                <div class="flex flex-col flex-1 mr-4 space-y-4">
                    <input class=" rounded" type="text" wire:model="newThreadTitle"
                        placeholder="Enter the new thread title" />
                        @if($errors->has('newThreadTitle'))
                        <span>{{ $errors->first('newThreadTitle') }}</span>
                       @endif
                    <textarea class=" rounded" type="text" wire:model="newThreadBody"
                        placeholder="Enter the body of the thread here !"></textarea>
                        @if($errors->has('newThreadBody'))
                        <span>{{ $errors->first('newThreadBody') }}</span>
                       @endif
                </div>
                <div>
                    <button class="max-h-16 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        wire:click="addNewThread">Save</button>
                </div>
            </div>
        </div>
    </x-containers.main-body>
    @endauth
</div>