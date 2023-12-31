@component('components.activities.activity')
    @slot('heading')
    <i class="fa-solid fa-pen-nib"></i>  {{ $profileUser->name }} published 
            <a class="url" href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
    @endslot

    @slot('body')
        {{$activity->subject->body }}
    @endslot
@endcomponent

