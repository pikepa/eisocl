<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <x-containers.main-body>
        <x-threads.thread-item :threads="$threads" />
    </x-containers.main-body>

</div>
