<div>
    @if($social)
        <p class="uppercase text-gray-500 md:mb-6">Socials</p>
        <ul class="list-reset mb-6">
            @if(!empty($social->instagram))
                <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                    <a target="_blank" href="{{ 'https://www.instagram.com/'.$social->instagram }}"
                       class="no-underline hover:underline text-gray-800 hover:text-pink-500">Instagram</a>
                </li>
            @endif

            @if(!empty($social->facebook))
                <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                    <a target="_blank" href="{{ 'https://www.facebook.com/'.$social->facebook }}"
                       class="no-underline hover:underline text-gray-800 hover:text-pink-500">Facebook</a>
                </li>
            @endif

            @if(!empty($social->twitter))
                <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                    <a target="_blank" href="{{ 'https://www.twitter.com/'.$social->twitter }}"
                       class="no-underline hover:underline text-gray-800 hover:text-pink-500">Twitter</a>
                </li>
            @endif

            @if(!empty($social->linkedin))
                <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                    <a target="_blank" href="{{ 'https://www.linkedin.com/in/'.$social->linkedin }}"
                       class="no-underline hover:underline text-gray-800 hover:text-pink-500">Linkedin</a>
                </li>
            @endif
        </ul>
    @endif
</div>
