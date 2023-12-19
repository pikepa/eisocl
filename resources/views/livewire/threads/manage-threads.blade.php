<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <x-containers.main-body>
        @foreach($threads as $thread)
                <x-threads.thread-item :thread="$thread" />
        @endforeach
    </x-containers.main-body>
    <!-- Add a New Reply -->
    
</div>