<div class=" flex justify-center w-full">
    <h1 x-data="{
    startingAnimation: { opacity: 0, scale: 4 },
    endingAnimation: { opacity: 1, scale: 1, stagger: 0.07, duration: 1, ease: 'expo.out' },
    addCNDScript: true,
    animateText() {
        $el.classList.remove('invisible');
        gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
    },
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
    }
}"
        x-init="
    splitCharactersIntoSpans($el);
    if(addCNDScript){
        addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
    }
    gsapInterval = setInterval(function(){
        if(typeof gsap !== 'undefined'){
            animateText();
            clearInterval(gsapInterval);
        }
    }, 5);
"
        class="decoration-4 tracking-normal antialiased drop-shadow-xl font-black leading-tight text-5xl md:text-8xl w-full indent-px my-12
                ">
        {{ $hero->mainQuote }}
    </h1>
</div>
