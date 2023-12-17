<div>
<div class="flex flex-row justify-between items-center">
    <div class="p-2 pl-4 ">
        <a class="text-xl  text-blue-500" href="{{ $thread->path() }}">{{ $thread->title }}</a>
    </div>
    <div class="text-sm mr-4 p-2  text-blue-500">
        <strong><a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a></strong>
    </div>
</div>
    <div class="pl-4 pr-4 pb-4 border-b-2 border-b-gray-100 text-gray-900">
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