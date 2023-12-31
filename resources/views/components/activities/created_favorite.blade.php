@component('components.activities.activity')
    @slot('heading')
      <a class="url" href="{{ $activity->subject->favorited->path()}}"><i class="fa-solid fa-heart"></i>  &nbsp;  {{  $profileUser->name  }} favorited a reply</a>
    @endslot

    @slot('body')
        {{  $activity->subject->favorited->body }} 
    @endslot
@endcomponent
 