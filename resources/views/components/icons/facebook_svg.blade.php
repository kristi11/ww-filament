<div
    x-data="{
tooltipVisible: false,
tooltipText: 'Facebook',
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
                <button wire:click="facebook" title="Facebook"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full py-4 px-8 focus:outline-none transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg width="40px" height="40px" viewBox="0 -0.5 25 25" fill="none"
                         xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M11.75 19C11.75 19.4142 12.0858 19.75 12.5 19.75C12.9142 19.75 13.25 19.4142 13.25 19H11.75ZM13.25 11C13.25 10.5858 12.9142 10.25 12.5 10.25C12.0858 10.25 11.75 10.5858 11.75 11H13.25ZM15.5 5.75C15.9142 5.75 16.25 5.41421 16.25 5C16.25 4.58579 15.9142 4.25 15.5 4.25V5.75ZM12.5 8H11.75H12.5ZM11.75 11C11.75 11.4142 12.0858 11.75 12.5 11.75C12.9142 11.75 13.25 11.4142 13.25 11H11.75ZM12.5 10.25C12.0858 10.25 11.75 10.5858 11.75 11C11.75 11.4142 12.0858 11.75 12.5 11.75V10.25ZM14.5 11.75C14.9142 11.75 15.25 11.4142 15.25 11C15.25 10.5858 14.9142 10.25 14.5 10.25V11.75ZM12.5 11.75C12.9142 11.75 13.25 11.4142 13.25 11C13.25 10.5858 12.9142 10.25 12.5 10.25V11.75ZM10.5 10.25C10.0858 10.25 9.75 10.5858 9.75 11C9.75 11.4142 10.0858 11.75 10.5 11.75V10.25ZM13.25 19V11H11.75V19H13.25ZM15.5 4.25C13.4289 4.25 11.75 5.92893 11.75 8H13.25C13.25 6.75736 14.2574 5.75 15.5 5.75V4.25ZM11.75 8V11H13.25V8H11.75ZM12.5 11.75H14.5V10.25H12.5V11.75ZM12.5 10.25H10.5V11.75H12.5V10.25Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
