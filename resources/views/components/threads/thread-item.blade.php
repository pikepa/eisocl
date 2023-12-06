<div>
    @foreach($threads as $thread)
    <div class="p-6 pb-0 text-xl  text-blue-500">
        <a href="/threads/ {{ $thread->id }} ">{{ $thread->title }}</a>
    </div>
    <div class="pl-6 pb-4 border-b-2 border-b-gray-100 text-gray-900">
        {{ $thread->body }}
        <div class="pt-3 text-xs">
            Created by {{ $thread->creator->name }} - {{ $thread->created_at->diffForHumans() }}
        </div>
    </div>
    @endforeach
</div>