<x-containers.reply-body>
    <div id="reply-{{ $reply->id }}">
        {{ $reply->body }}
        <div class="flex flex-row text-xs items-center justify-between">
            <div class="flex flex-row items-center justify-between">
                <div class="pt-4 pr-1 font-extralight ">
                    Created by
                </div>
                <div class="pt-4 font-extralight  text-blue-700">
                    <a href="/activities/{{ $reply->owner->id }}">{{ $reply->owner->name }}</a>
                </div>
                <div class="pt-4 pl-1 font-extralight ">
                    - {{ $reply->created_at->diffForHumans() }}
                </div>

            </div>
<div class="space-x-4">
    @can ('update', $reply)
    <button wire:click="deleteThisReply({{ $reply->id }})" class="border text-gray-100 bg-red-500 font-semibold rounded-lg px-4 py-2 focus:cursor-auto   {{ $reply->isFavorited() ? 'opacity-50' : '' }}">
        Delete
    </button>
    @endcan
    <button wire:click='addFavorite({{ $reply->id }})' class="border text-gray-100 font-semibold rounded-lg px-4 py-2 bg-sky-700  focus:cursor-auto   {{ $reply->isFavorited() ? 'opacity-50' : '' }}"
        {{ $reply->isFavorited() ? 'disabled' : '' }} >
        {{ $reply->favorites_count }} {{ Str::plural('favorite', $reply->favorites_count) }}
    </button>
</div>
        </div>
    </div>
</x-containers.reply-body>