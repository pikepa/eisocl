<div>
    <x-slot name="header">
    <div class="relative">
        <h2 class="ml-12 text-2xl text-left font-semibold text-blue-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </div>
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