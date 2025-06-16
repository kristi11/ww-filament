
<!DOCTYPE html>
<html ang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <livewire:guest-links/>
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
