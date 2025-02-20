<div>
    @if($socials)
        <section id="login" class="py-8 lg:p-20"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <div class="container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-2 justify-center">
                    @if(!empty($socials->instagram))
                        <div>
                            <x-icons.instagram_svg/>
                        </div>
                    @endif

                    @if(!empty($socials->facebook))
                        <div>
                            <x-icons.facebook_svg/>
                        </div>
                    @endif

                    @if(!empty($socials->twitter))
                        <div>
                            <x-icons.twitter_svg/>
                        </div>
                    @endif

                    @if(!empty($socials->linkedin))
                        <div>
                            <x-icons.linkedin_svg/>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
