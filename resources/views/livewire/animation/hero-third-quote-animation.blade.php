<div class="flex justify-center w-full">
    <p x-data="{
startingAnimation: { opacity: 0 },
endingAnimation: { opacity: 1, stagger: 0.08, duration: 2.7, ease: 'power4.easeOut' },
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
gsapInterval3 = setInterval(function(){
if(typeof gsap !== 'undefined'){
animateText();
clearInterval(gsapInterval3);
}
}, 5);
"
        class="lg:text-3xl text-xl tracking-loose uppercase w-full antialiased drop-shadow-lg text-gray-300 font-bold text-center invisible"
    >
        {{ $hero->thirdQuote }}
    </p>
</div>
