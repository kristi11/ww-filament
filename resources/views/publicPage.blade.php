
<!DOCTYPE html>
<html lang="en" class="proze">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @livewireStyles
</head>
<body>
    <livewire:guestHeader />
    <livewire:guestContent/>
    <livewire:guest-call-to-action />
    <livewire:guest-footer />
    <livewire:guest-js-scripts />
    @livewireScripts
</body>
</html>
