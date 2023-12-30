@component('components.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} replied to 
        <a href="#">"{$activity->subject->title}"</a> 
    @endslot

    @slot('body')
Reply Body   
    @endslot
@endcomponent
 