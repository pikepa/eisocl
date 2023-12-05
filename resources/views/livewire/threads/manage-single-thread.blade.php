<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($thread->title)}}
        </h2>
    </x-slot>
    <!-- main body -->
    <div class="max-w-4xl mx-auto pt-4 ">
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 pb-6 border-b-2 border-b-gray-100 text-gray-900">
                {{ $thread->body }}
            </div>
        </div>
    </div>
    @foreach($thread->replies as $reply)

    <div class="max-w-4xl mx-auto pl-8 pt-2 ">

        <div class=" bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="pl-6 pt-2 font-extralight text-xs text-blue-500">
                {{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}
            </div>
            <div class="px-6 pt-4 pb-6 border-b-2 border-b-gray-100 text-gray-900">
                {{ $reply->body }}
            </div>
        </div>
    </div>
    @endforeach

</div>