<div>
    @if($gallery)
        <section id="gallery" class="
{{--        {{ $background->hoursBackgroundColor }}--}}
        bg-slate-50
         py-8">
            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Check out the <a class="hover:text-indigo-600 text-indigo-500"
                                 href=" {{ url('dashboard/service-images') }} ">
                    gallery
                </a>
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
        </section>
    @endif
</div>
