<div>
    <body class="leading-normal tracking-normal gradient"
          style="font-family: 'Source Sans Pro', sans-serif;">
    {{--The <x-get-repo/> is only for developers to get a link to the github repository. It's safe to delete this component when using this repository for your own project. This is just a blade file with a link in it and has not links to other places in the project--}}
    <x-get-repo/>

    @foreach($sectionPositions as $sectionName)
        @switch($sectionName)
            @case('display-socials')
                <livewire:display-socials/>
                @break
            @case('guest-login')
                <livewire:guest-login/>
                @break
            @case('display-guest-services')
                <livewire:display-guest-services/>
                @break
            @case('guest-shop-display')
                <livewire:guest-shop-display/>
                @break
            @case('display-guest-business-hours')
                <livewire:display-guest-business-hours/>
                @break
            @case('display-guest-gallery')
                <livewire:display-guest-gallery/>
                @break
        @endswitch
    @endforeach

    </body>
</div>
