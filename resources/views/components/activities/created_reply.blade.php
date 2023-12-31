@component('components.activities.activity')
    @slot('heading')
    <i class="fa-solid fa-comment-dots"></i> {{ $profileUser->name }} replied to 
        <a class="url" href="{{  $activity->subject->thread->path() }}">{{  $activity->subject->thread->title }}</a> 
    @endslot

    @slot('body')
    {{  $activity->subject->body }} 
        @endslot
@endcomponent
 