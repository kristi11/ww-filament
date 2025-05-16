@component('mail::message')

# New Contact Form Submission

You have received a new contact form submission from **{{ $lead->name }}**.

## Contact Details

**Name:** {{ $lead->name }}

**Email:** {{ $lead->email }}

@if($lead->phone)
**Phone:** {{ $lead->phone }}

@endif

## Message
{{ $lead->message }}

@component('mail::button', ['url' => url('/admin/leads'), 'color' => 'primary'])
View in Admin Panel
@endcomponent

@endcomponent
