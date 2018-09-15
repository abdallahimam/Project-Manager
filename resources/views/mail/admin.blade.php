@component('mail::message')
# Welcome

The body of your message.

<hr />
{{ $message }}
@component('mail::button', ['url' => url('/')])
Click Me
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
