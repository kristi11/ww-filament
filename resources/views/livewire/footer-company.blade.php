<div>
    <p class="uppercase text-gray-500 md:mb-6">Company</p>
    <ul class="list-reset mb-6">
        {{-- <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Official Blog</a>
        </li> --}}
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($about)
                <a href="{{ route('about') }}" target="_blank"
                   class="no-underline hover:underline transition duration-300"
                   style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.5);">
                    About Us
                </a>
            @endif
        </li>
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($contact)
                <a href="{{ route('contact') }}" target="_blank"
                   class="no-underline hover:underline transition duration-300"
                   style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.5);">
                    Contact
                </a>
            @endif
        </li>
    </ul>
</div>
