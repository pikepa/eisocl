<x-containers.reply-body>
 <div x-data="{ open:true}">
    <div x-show="!open">
            <div class="flex flex-row justify-between ">
                <textarea class="flex-1  rounded" type="text" wire:model="replyEdit" required></textarea>
            </div>
            @if($errors->has('replyEdit'))
            <span class="text-sm text-red-600 font-semibold">{{ $errors->first('replyEdit') }}</span>
            @endif
    </div>
    <div x-show="open" id="reply-{{ $reply->id }}">
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


                <span class="inline-flex rounded-md shadow-sm">
                    <button wire:click='toggleFavorite({{ $reply->id }})'
                        class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-cyan-600 hover:bg-cyan-500 focus:outline-none focus:border-cyan-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                         <span class="mr-1"> {{ $reply->favorites_count }}</span>
                         <i class="fa-regular fa-heart"></i> 
                         <span class="m-1">'s</span>


                    </button>
                </span>
            </div>
        </div>

    </div>
    @can('update',$reply)

    <div class="flex flex-row justify-start space-x-4 mt-4 pt-4 border-t-2 border-b-gray-100 text-gray-500">
        <div class="ml-4" x-show="!open">
            <span class=" inline-flex rounded-md shadow-sm">
                <button 
                    wire:click="saveEdit({{ $reply->id }})" 
                    x-on:click="open = ! open"
                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Save
                </button>
            </span>
            <span class=" inline-flex rounded-md shadow-sm">
                <button x-on:click="open = ! open"
                    class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-cyan-600 hover:bg-cyan-500 focus:outline-none focus:border-cyan-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    Cancel
                </button>
            </span>
        </div>
<div x-show="open" >

    <span class=" inline-flex rounded-md shadow-sm">
        <button x-on:click="open = ! open" wire:click="editReply({{ $reply->id }})"
            class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-cyan-600 hover:bg-cyan-500 focus:outline-none focus:border-cyan-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            Edit
        </button>
    </span>
    <span class=" inline-flex rounded-md shadow-sm">
        <button wire:click="deleteThisReply({{ $reply->id }})"
            class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
            Delete
        </button>
    </span>

</div>
    </div>
    @endcan
 </div>
</x-containers.reply-body>