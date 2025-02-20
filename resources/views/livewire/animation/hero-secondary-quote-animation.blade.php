{{--<div class="flex justify-center w-full">--}}
{{--    <p x-data="{--}}
{{--startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },--}}
{{--endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },--}}
{{--addCNDScript: true,--}}
{{--splitCharactersIntoSpans(element) {--}}
{{--text = element.innerHTML;--}}
{{--modifiedHTML = [];--}}
{{--for (var i = 0; i < text.length; i++) {--}}
{{--attributes = '';--}}
{{--if(text[i].trim()){ attributes = 'class=\'inline-block\''; }--}}
{{--modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');--}}
{{--}--}}
{{--element.innerHTML = modifiedHTML.join('');--}}
{{--},--}}
{{--addScriptToHead(url) {--}}
{{--script = document.createElement('script');--}}
{{--script.src = url;--}}
{{--document.head.appendChild(script);--}}
{{--},--}}
{{--animateText() {--}}
{{--$el.classList.remove('invisible');--}}
{{--gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);--}}
{{--}--}}
{{--}"--}}
{{--        x-init="--}}
{{--splitCharactersIntoSpans($el);--}}
{{--if(addCNDScript){--}}
{{--addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');--}}
{{--}--}}
{{--gsapInterval2 = setInterval(function(){--}}
{{--if(typeof gsap !== 'undefined'){--}}
{{--animateText();--}}
{{--clearInterval(gsapInterval2);--}}
{{--}--}}
{{--}, 5);--}}
{{--"--}}
{{--        class="leading-normal lg:text-5xl md:text-4xl text-3xl w-full antialiased drop-shadow-xl mb-12"--}}
{{--    >--}}
{{--        {{ $hero->secondaryQuote }}--}}
{{--    </p>--}}
{{--</div>--}}




<div class="flex justify-center w-full mt-8">
    <p x-data="{
        startingAnimation: { opacity: 0, y: 30, rotation: '15deg' },
        endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.015, duration: 0.5, ease: 'back' },
        addCNDScript: true,
        splitCharactersIntoSpans(element) {
            text = element.innerHTML;
            modifiedHTML = [];
            for (var i = 0; i < text.length; i++) {
                attributes = '';
                if(text[i].trim()){ attributes = 'class=\'inline-block\''; }
                modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
            }
            element.innerHTML = modifiedHTML.join('');
        },
        addScriptToHead(url) {
            script = document.createElement('script');
            script.src = url;
            document.head.appendChild(script);
        },
        animateText() {
            $el.classList.remove('invisible');
            gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
        }
    }"
       x-init="
        splitCharactersIntoSpans($el);
        if(addCNDScript){
            addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
        }
        gsapInterval2 = setInterval(function(){
            if(typeof gsap !== 'undefined'){
                animateText();
                clearInterval(gsapInterval2);
            }
        }, 5);
    "
       class="leading-tight lg:text-5xl md:text-4xl text-3xl w-full
           antialiased font-black
           drop-shadow-lg mb-12 max-w-5xl mx-auto
           tracking-tight text-center"
    >
        {{ $hero->secondaryQuote }}
    </p>
</div>
