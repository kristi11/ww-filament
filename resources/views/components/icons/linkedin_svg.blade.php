<div
    x-data="{
tooltipVisible: false,
tooltipText: 'Linkedin',
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
                <button wire:click="linkedin" title="Linkedin"
                        class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full py-4 px-8 focus:outline-none transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg width="40px" height="40px" viewBox="0 -0.5 25 25" fill="none"
                         xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M8.75 11C8.75 10.5858 8.41421 10.25 8 10.25C7.58579 10.25 7.25 10.5858 7.25 11H8.75ZM7.25 17C7.25 17.4142 7.58579 17.75 8 17.75C8.41421 17.75 8.75 17.4142 8.75 17H7.25ZM17.25 17C17.25 17.4142 17.5858 17.75 18 17.75C18.4142 17.75 18.75 17.4142 18.75 17H17.25ZM12 14H11.25H12ZM11.25 17C11.25 17.4142 11.5858 17.75 12 17.75C12.4142 17.75 12.75 17.4142 12.75 17H11.25ZM8.75 8C8.75 7.58579 8.41421 7.25 8 7.25C7.58579 7.25 7.25 7.58579 7.25 8H8.75ZM7.25 9C7.25 9.41421 7.58579 9.75 8 9.75C8.41421 9.75 8.75 9.41421 8.75 9H7.25ZM7.25 11V17H8.75V11H7.25ZM18.75 17V14H17.25V17H18.75ZM18.75 14C18.75 11.9289 17.0711 10.25 15 10.25V11.75C16.2426 11.75 17.25 12.7574 17.25 14H18.75ZM15 10.25C12.9289 10.25 11.25 11.9289 11.25 14H12.75C12.75 12.7574 13.7574 11.75 15 11.75V10.25ZM11.25 14V17H12.75V14H11.25ZM7.25 8V9H8.75V8H7.25Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
