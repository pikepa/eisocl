<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create New forum Thread') }}
    </h2>
</x-slot>
<x-containers.main-body>
    <div class="py-6 px-4 border-b-2 border-b-gray-100 text-gray-900">
        <div class="flex flex-row justify-between ">
            <div class="flex flex-col flex-1 mr-4 space-y-4">
                <select wire:model="channelId">
                    <option value="">Select a Channel</option>
                    @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('channelId'))
                <span class="text-sm text-red-600 font-semibold">{{ $errors->first('channelId') }}</span>
                @endif

                <input class=" rounded" type="text" wire:model="newThreadTitle"
                    placeholder="Enter the new thread title" />
                @if($errors->has('newThreadTitle'))
                <span class="text-sm text-red-600 font-semibold">{{ $errors->first('newThreadTitle') }}</span>
                @endif
                <textarea class=" rounded" type="text" wire:model="newThreadBody"
                    placeholder="Enter the body of the thread here !"></textarea>
                @if($errors->has('newThreadBody'))
                <span class="text-sm text-red-600 font-semibold">{{ $errors->first('newThreadBody') }}</span>
                @endif
            </div>
            <div>
                <button class="max-h-16 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="addNewThread">Publish</button>
            </div>
        </div>
    </div>
</x-containers.main-body>