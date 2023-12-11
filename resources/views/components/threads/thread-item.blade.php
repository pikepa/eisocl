<div>
    <div class="p-6 pb-0 ">
        <a class="text-xl  text-blue-500" href="/threads/ {{ $thread->id }} ">{{ $thread->title }}</a>
    </div>
    <div class="pl-6 pb-4 border-b-2 border-b-gray-100 text-gray-900">
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