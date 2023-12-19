<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <x-containers.main-body>
        @forelse($threads as $thread)
                <x-threads.thread-item :thread="$thread" />
        @empty
        <p class="text-center">There are no relevant results at this time.</p>
        @endforelse
    </x-containers.main-body>
    <!-- Add a New Reply -->
    
</div>