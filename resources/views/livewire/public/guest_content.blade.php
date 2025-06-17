<div>
    <body class="leading-normal tracking-normal gradient overflow-x-hidden"
          style="font-family: 'Source Sans Pro', sans-serif;">
    {{--The <x-get-repo/> is only for developers to get a link to the github repository. It's safe to delete this component when using this repository for your own project. This is just a blade file with a link in it and has not links to other places in the project--}}
    <x-get-repo/>

    @foreach($sectionPositions as $sectionName)
        @switch($sectionName)
            @case('display-socials')
                <x-scroll-animation animation="fade" direction="up" duration="700">
                    <livewire:display-socials/>
                </x-scroll-animation>
                @break
            @case('guest-login')
                <x-scroll-animation animation="fade" direction="up" duration="700" delay="100">
                    <livewire:guest-login/>
                </x-scroll-animation>
                @break
            @case('display-guest-services')
                <x-scroll-animation animation="fade" direction="up" duration="700" delay="200">
                    <livewire:display-guest-services/>
                </x-scroll-animation>
                @break
            @case('guest-shop-display')
                <x-scroll-animation animation="zoom" duration="700" delay="100">
                    <livewire:guest-shop-display/>
                </x-scroll-animation>
                @break
            @case('display-guest-business-hours')
                <x-scroll-animation animation="fade" direction="left" duration="700">
                    <livewire:display-guest-business-hours/>
                </x-scroll-animation>
                @break
            @case('display-guest-gallery')
                <x-scroll-animation animation="fade" direction="right" duration="700" delay="200">
                    <livewire:display-guest-gallery/>
                </x-scroll-animation>
                @break
        @endswitch
    @endforeach

    </body>
</div>
