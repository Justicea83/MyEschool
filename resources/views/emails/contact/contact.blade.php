@component('mail::message')
From {{$firstname}},
    @component('mail::panel')
        {{$body}}
        @endcomponent
<br>
{{--@component('mail::button', ['url' => $email])
Reply
@endcomponent--}}
<a>Reply {{$email}}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
