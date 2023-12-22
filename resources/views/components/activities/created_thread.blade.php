<div class="">
    <div class="rounded-lg border-2 border-gray-300 mb-4 p-4 pt-2">
        <div class="  text-gray-900 text-lg">
            <div class="border-b flex flex-row justify-between items-center ">
                <div class="  ">
                    <a class="" href="">{{ $profileUser->name }} published the thread : 
                        <a class=" text-blue-500"  href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a> 
                </div>
            </div>
            <div class="flex flex-row justify-between ">
                <div class="flex flex-row">
                    <div class="pt-4 pr-1 ">
                        {{ $activity->subject->body }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>