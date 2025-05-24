<div
    x-data="{
tooltipVisible: false,
tooltipText: 'Twitter',
tooltipArrow: true,
tooltipPosition: 'top',
}"
    x-init="$refs.content.addEventListener('mouseenter', () => { tooltipVisible = true; }); $refs.content.addEventListener('mouseleave', () => { tooltipVisible = false; });"
    class="relative">
    <div x-ref="tooltip" x-show="tooltipVisible"
         :class="{ 'top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full' : tooltipPosition == 'top', 'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full' : tooltipPosition == 'left', 'bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full' : tooltipPosition == 'bottom', 'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full' : tooltipPosition == 'right' }"
         class="absolute w-auto text-sm" x-cloak>
        <div x-show="tooltipVisible" x-transition class="relative px-2 py-1 text-white bg-black rounded bg-opacity-90">
            <p x-text="tooltipText" class="flex-shrink-0 block text-xs whitespace-nowrap"></p>
            <div x-ref="tooltipArrow" x-show="tooltipArrow"
                 :class="{ 'bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full' : tooltipPosition == 'top', 'right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full' : tooltipPosition == 'left', 'top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full' : tooltipPosition == 'bottom', 'left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full' : tooltipPosition == 'right' }"
                 class="absolute inline-flex items-center justify-center overflow-hidden">
                <div
                    :class="{ 'origin-top-left -rotate-45' : tooltipPosition == 'top', 'origin-top-left rotate-45' : tooltipPosition == 'left', 'origin-bottom-left rotate-45' : tooltipPosition == 'bottom', 'origin-top-right -rotate-45' : tooltipPosition == 'right' }"
                    class="w-1.5 h-1.5 transform bg-black bg-opacity-90"></div>
            </div>
        </div>
    </div>
    <div x-ref="content" class="px-3 py-1 text-xs rounded-full cursor-pointer text-neutral-500">
        <div>
            <div class="col-span-1">
                <button wire:click="twitter" title="Twitter"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full py-4 px-8 focus:outline-none transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg width="40px" height="40px" viewBox="0 0 48 48" id="Layer_2" data-name="Layer 2"
                         xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <defs>
                                <style>.cls-1 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                    }</style>
                            </defs>
                            <path class="cls-1"
                                  d="M38.74,16.55v1c0,10.07-7.64,21.61-21.62,21.61A21.14,21.14,0,0,1,5.5,35.71a12.22,12.22,0,0,0,1.81.11,15.25,15.25,0,0,0,9.44-3.24,7.56,7.56,0,0,1-7.1-5.29,6.9,6.9,0,0,0,1.44.15,7.53,7.53,0,0,0,2-.27A7.57,7.57,0,0,1,7,19.72v-.1a7.42,7.42,0,0,0,3.44.94A7.54,7.54,0,0,1,8.05,10.5a21.58,21.58,0,0,0,15.68,7.94,6.38,6.38,0,0,1-.21-1.74,7.55,7.55,0,0,1,13.17-5.31,15.59,15.59,0,0,0,4.83-1.85,7.65,7.65,0,0,1-3.39,4.27,15.87,15.87,0,0,0,4.37-1.26,15.56,15.56,0,0,1-3.76,4Z"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
