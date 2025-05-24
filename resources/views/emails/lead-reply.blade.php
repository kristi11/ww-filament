@component('mail::message')

# {{ $emailSubject }}

{!! $emailMessage !!}

@component('mail::button', ['url' => url('/contact'), 'color' => 'primary'])
Contact Us Again
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
