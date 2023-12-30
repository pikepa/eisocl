@component('components.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} published {{ $activity->subject->title }}
    @endslot

    @slot('body')
        {{$activity->subject->body }}
    @endslot
@endcomponent

