<div>
    @if($socials)
        <section id="login" class="bg-white py-8 lg:p-20">
            <div class="container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-2 justify-center">

                        @if(!empty($socials->instagram))
                            <x-icons.instagram_svg/>
                        @endif

                        @if(!empty($socials->facebook))
                            <x-icons.facebook_svg/>
                        @endif

                        @if(!empty($socials->twitter))
                            <x-icons.twitter_svg/>
                        @endif

                        @if(!empty($socials->linkedin))
                            <x-icons.linkedin_svg/>
                        @endif

                    </div>
            </div>
        </section>
    @endif
</div>
