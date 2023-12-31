<div class="">
    <div class="rounded-lg border-2 border-gray-300 mb-4 p-4 pt-2">
        <div class="  text-gray-900">
            <div class="flex flex-row justify-between items-center ">
                <div class="  ">
                    <a class="url" href="{{ $thread->path() }}">{{ $thread->title }}</a>
                </div>
                <div class="text-sm mr-4 p-2 ">
                    <a class="url" href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ Str::plural('reply',
                            $thread->replies_count) }}</a>
                </div>
            </div>
            <div>
                {{ $thread->body }}
            </div>
            <div class="flex flex-row justify-between ">
                <div class="flex flex-row text-xs">
                    <div class="pt-4 pr-1 font-extralight ">
                        Created by
                    </div>
                    <div class="pt-4 ">
                        <a class="url" href="#">{{ $thread->creator->name }}</a>
                    </div>
                    <div class="pt-4 pl-1 font-extralight ">
                        - {{ $thread->created_at->diffForHumans() }}
                    </div>
                </div>
                @can('update', $thread)
                <button class="pt-4 pr-4 text-xs hover:text-red-900 text-red-700 font-extralight ">
                    <div wire:click='deleteThread({{ $thread->id }})' class="">Delete Thread</div>
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>