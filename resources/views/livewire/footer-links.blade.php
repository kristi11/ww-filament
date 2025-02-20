<div>
    <p class="uppercase text-gray-500 md:mb-6">Links</p>
    <ul class="list-reset mb-6">
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($faq)
                <a href="{{ route('faq') }}" target="_blank"
                   class="no-underline hover:underline transition duration-300"
                   style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.5);">
                    FAQ
                </a>
            @endif
        </li>
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($help)
                <a href="{{ route('help') }}" target="_blank"
                   class="no-underline hover:underline transition duration-300"
                   style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.5);">
                    Help
                </a>
            @endif
        </li>
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($support)
                <a href="{{ route('support') }}" target="_blank"
                   class="no-underline hover:underline transition duration-300"
                   style="color: {{$hero->gradientDegreeFirstColor}}; filter: brightness(0.5);">
                    Support
                </a>
            @endif
        </li>
    </ul>
</div>
