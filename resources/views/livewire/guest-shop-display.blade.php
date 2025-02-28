<div>
    @if($shop)
        <section id="shop" class="py-20 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0" style="background-color: #F9FAFB"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: linear-gradient(to bottom, transparent, {{$hero->gradientDegreeFirstColor}}, transparent)"></div>

            <div class="container mx-auto px-4 relative">
                <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="space-y-8">
                        <h2 style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.6);" class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                            Build your success story with our shop
                        </h2>


                        <p style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.1)" class="text-lg md:text-xl leading-relaxed">
                            Take control of your business and start your journey today with our powerful e-commerce platform.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{route('shop')}}"
                               target="_blank"
                               style="position: relative; color: #FFFFFF; overflow: hidden;"
                               class="inline-flex items-center justify-center px-8 py-4 font-medium rounded-full
          hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1
          text-lg">
    <span style="position: absolute; inset: 0; background-color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.9); z-index: -1;"
          onmouseover="this.style.backgroundColor='#1D4ED8'"></span>
                                Start exploring
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 ml-2"
                                     viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>

                        <div class="flex items-center gap-6 pt-6">
                            <div class="flex items-center gap-2">
                                <svg style="color: {{$hero->gradientDegreeFirstColor}}" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.3);" class="text-sm font-medium">
            Secure checkout
        </span>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="relative rounded-2xl p-8 shadow-xl"
                             style="background-image: linear-gradient(to bottom right, #FFFFFF, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 5%, white))">

                        <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 style="stroke: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.85);"
                                 class="w-full h-full transform transition-transform duration-500 hover:scale-105">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>

                            <div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full blur-xl"
                                 style="background-color: {{$hero->gradientDegreeFirstColor}}; opacity: 0.1"></div>
                            <div class="absolute -left-4 -top-4 w-32 h-32 rounded-full blur-xl"
                                 style="background-color: {{$hero->gradientDegreeFirstColor}}; opacity: 0.1"></div>
                        </div>

                        <div class="absolute -left-6 bottom-1/4 bg-white px-6 py-4 rounded-lg shadow-lg transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                            <p style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.6);" class="font-bold text-xl">Premium</p>
                            <p style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.3);" class="text-sm">Quality Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
