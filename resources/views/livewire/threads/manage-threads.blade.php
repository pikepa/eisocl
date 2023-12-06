<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ephraim Island Social Club Forum') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <div class="pt-4 max-w-4xl mx-auto ">
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            <x-threads.thread-item :threads="$threads" />
        </div>
    </div>
</div>
