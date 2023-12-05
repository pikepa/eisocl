<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum Threads') }}
        </h2>
    </x-slot>
    <!-- main body -->
    <div class="pt-4 max-w-4xl mx-auto ">
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
            @foreach($threads as $thread)
            <div class="p-6 pb-0 text-xl  text-blue-500">
               <a href="/threads/ {{ $thread->id }} ">{{  $thread->title }}</a>
            </div>
            <div class="pl-6 pb-6 border-b-2 border-b-gray-100 text-gray-900">
                {{  $thread->body }}
            </div>
              

            @endforeach
        </div>
    </div>
</div>
