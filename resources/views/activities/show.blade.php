<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activity Feed for ') }}{{ $profileUser->name }}
            </h2>
        </x-slot>
        <!-- main body -->
        <x-containers.main-body>
            @foreach($activities as $date => $activity)
            <div class="m-4 text-2xl font-semibold py-2">
                {{ $date }}
            </div>
            <div class="pl-8">
                @foreach($activity as $record)
                    @if (view()->exists("components.activities.{$record->type}"))
                        @include ("components.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            </div>
            @endforeach
        </x-containers.main-body>
        <!-- Add a New Reply -->

    </div>
</x-app-layout>