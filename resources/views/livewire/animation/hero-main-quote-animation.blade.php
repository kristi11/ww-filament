<div
    x-data="{
        text: '',
        textArray : ['{{ $hero->mainQuote }}'],
        textIndex: 0,
        charIndex: 0,
        typeSpeed: 70,
        cursorSpeed: 550,
        pauseEnd: 60000,
        pauseStart: 20,
        direction: 'forward',
        isVisible: false
    }"
    x-init="$nextTick(() => {
        isVisible = true;
        let typingInterval = setInterval(startTyping, $data.typeSpeed);

        function startTyping(){
            let current = $data.textArray[ $data.textIndex ];

            if($data.charIndex > current.length){
                $data.direction = 'backward';
                clearInterval(typingInterval);
                setTimeout(function(){
                    typingInterval = setInterval(startTyping, $data.typeSpeed);
                }, $data.pauseEnd);
            }

            $data.text = current.substring(0, $data.charIndex);

            if($data.direction == 'forward') {
                $data.charIndex += 1;
            } else {
                if($data.charIndex == 0) {
                    $data.direction = 'forward';
                    clearInterval(typingInterval);
                    setTimeout(function(){
                        $data.textIndex += 1;
                        if($data.textIndex >= $data.textArray.length) {
                            $data.textIndex = 0;
                        }
                        typingInterval = setInterval(startTyping, $data.typeSpeed);
                    }, $data.pauseStart);
                }
                $data.charIndex -= 1;
            }
        }

        setInterval(function(){
            if($refs.cursor.classList.contains('hidden')) {
                $refs.cursor.classList.remove('hidden');
            } else {
                $refs.cursor.classList.add('hidden');
            }
        }, $data.cursorSpeed);
    })"
    class="flex items-center justify-center min-h-[40vh] mx-auto px-4">

    <div class="relative flex items-center justify-center w-full max-w-7xl">
        <span class="absolute -left-4 -top-8 text-8xl text-gray-200 font-serif select-none">"</span>

        <p
            x-text="text"
            class="font-black text-4xl md:text-7xl lg:text-8xl text-center
                   leading-tight tracking-tight
                   drop-shadow-lg
                   transition-all duration-300"
            x-show="text.length > 0"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100">
        </p>

        <span
            x-ref="cursor"
            class="absolute right-0 w-1 md:w-2 -mr-2 bg-slate-900 h-3/4 top-1/2 -translate-y-1/2">
        </span>

        <span class="absolute -right-4 -bottom-8 text-8xl text-gray-200 font-serif rotate-180 select-none">"</span>
    </div>
</div>
