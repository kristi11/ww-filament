<div>
    @if($socials)
        <section id="login" class="py-8 lg:p-20"
                 style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">
            <div class="container flex flex-wrap justify-center mx-auto pb-12 pt-4 rounded-lg">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-2 justify-center">
                    @if(!empty($socials->instagram))
                        <div class="transform transition-all duration-300 hover:scale-110"
                             x-data="{}"
                             x-animation="zoom-in bounce slow">
                            <div class="social-icon-wrapper relative overflow-hidden rounded-full">
                                <x-icons.instagram_svg/>
                                <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-500 opacity-0 hover:opacity-20 transition-opacity duration-300 rounded-full"></div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($socials->facebook))
                        <div class="transform transition-all duration-300 hover:scale-110"
                             x-data="{}"
                             x-animation="zoom-in bounce slow">
                            <div class="social-icon-wrapper relative overflow-hidden rounded-full">
                                <div class="p-0 m-0 inline-block">
                                    <x-icons.facebook_svg/>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-400 opacity-0 hover:opacity-20 transition-opacity duration-300 rounded-full"></div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($socials->twitter))
                        <div class="transform transition-all duration-300 hover:scale-110"
                             x-data="{}"
                             x-animation="zoom-in bounce slow">
                            <div class="social-icon-wrapper relative overflow-hidden rounded-full">
                                <div class="p-0 m-0 inline-block">
                                    <x-icons.twitter_svg/>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-300 opacity-0 hover:opacity-20 transition-opacity duration-300 rounded-full"></div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($socials->linkedin))
                        <div class="transform transition-all duration-300 hover:scale-110"
                             x-data="{}"
                             x-animation="zoom-in bounce slow">
                            <div class="social-icon-wrapper relative overflow-hidden rounded-full">
                                <div class="p-0 m-0 inline-block">
                                    <x-icons.linkedin_svg/>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-500 opacity-0 hover:opacity-20 transition-opacity duration-300 rounded-full"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Social connections animation -->
            <div class="hidden md:block relative mt-8 mb-4 h-16">
                <svg class="social-connections-svg mx-auto" width="300" height="60" viewBox="0 0 300 60">
                    <path class="connection-path" d="M30,30 C70,10 120,50 150,30 C180,10 230,50 270,30"
                          stroke="rgba(107, 114, 128, 0.3)"
                          stroke-width="2"
                          fill="none"
                          stroke-dasharray="5,5">
                        <animate attributeName="stroke-dashoffset"
                                 from="0"
                                 to="100"
                                 dur="3s"
                                 repeatCount="indefinite" />
                    </path>
                    <circle class="pulse-circle" cx="150" cy="30" r="8" fill="rgba(79, 70, 229, 0.6)">
                        <animate attributeName="r"
                                 values="4;8;4"
                                 dur="2s"
                                 repeatCount="indefinite" />
                        <animate attributeName="fill-opacity"
                                 values="0.6;0.2;0.6"
                                 dur="2s"
                                 repeatCount="indefinite" />
                    </circle>
                </svg>
            </div>

            <!-- Social heading with animation -->
            <div class="text-center mb-6" x-data="{}" x-animation="fade-in slide-in-bottom">
                <h3 class="text-xl font-semibold text-gray-700 relative inline-block after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-indigo-500 after:transition-all after:duration-500 hover:after:w-full">
                    Connect With Us
                </h3>
            </div>
        </section>
    @endif
</div>
