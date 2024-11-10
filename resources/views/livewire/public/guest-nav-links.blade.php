<div>
    <!--Nav-->
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                   href="#">
                    <!--Icon from: http://www.potlabicons.com/ -->
                    {{--                    <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.005 512.005">--}}
                    {{--                        <rect fill="#2a2a31" x="16.539" y="425.626" width="479.767" height="50.502" transform="matrix(1,0,0,1,0,0)" />--}}
                    {{--                        <path--}}
                    {{--                            class="plane-take-off"--}}
                    {{--                            d=" M 510.7 189.151 C 505.271 168.95 484.565 156.956 464.365 162.385 L 330.156 198.367 L 155.924 35.878 L 107.19 49.008 L 211.729 230.183 L 86.232 263.767 L 36.614 224.754 L 0 234.603 L 45.957 314.27 L 65.274 347.727 L 105.802 336.869 L 240.011 300.886 L 349.726 271.469 L 483.935 235.486 C 504.134 230.057 516.129 209.352 510.7 189.151 Z "--}}
                    {{--                        />--}}
                    {{--                    </svg>--}}
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                        class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
            <div
                class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    @if($services)
                        <li class="mr-3">
                            <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                               href="#services">Services</a>
                        </li>
                        @endif
                        @if($hours)
                            <li class="mr-3">
                                <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                   href="#hours">Hours</a>
                            </li>
                        @endif
                    @if($shop)
                        <li class="mr-3">
                            <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                               href="#shop">Shop</a>
                        </li>
                    @endif
                    @if($email)
                        <li class="mr-3">
                            <a class="inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                               href="#cta">Contact</a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0"/>
    </nav>
</div>
