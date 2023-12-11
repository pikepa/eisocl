<x-containers.reply-body>
            {{ $reply->body }}
            <div class="flex flex-row text-xs">
                <div class="pt-4 pr-1 font-extralight ">
                    Created by
                </div>
                <div class="pt-4 font-extralight  text-blue-700">
                    <a href="#">{{ $reply->owner->name }}</a>
                </div>
                <div class="pt-4 pl-1 font-extralight ">
                    - {{ $reply->created_at->diffForHumans() }}
                </div>
            </div>
</x-containers.reply-body>