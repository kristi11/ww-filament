<div>
    <p class="uppercase text-gray-500 md:mb-6">Company</p>
    <ul class="list-reset mb-6">
        {{--                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">--}}
        {{--                            <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Official--}}
        {{--                                Blog</a>--}}
        {{--                        </li>--}}
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            <a href="{{ route('about') }}" target="_blank"
               class="no-underline hover:underline text-gray-800 hover:text-pink-500">About
                Us</a>
        </li>
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            <a href="{{ route('contact') }}" target="_blank"
               class="no-underline hover:underline text-gray-800 hover:text-pink-500">Contact</a>
        </li>
    </ul>
</div>
