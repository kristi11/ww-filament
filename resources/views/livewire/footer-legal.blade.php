<div>
    <p class="uppercase text-gray-500 md:mb-6">Legal</p>
    <ul class="list-reset mb-6">
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($terms)
                <a href="{{ route('terms') }}" target="_blank"
                   class="no-underline hover:underline text-gray-800 hover:text-pink-500">Terms
                </a>
            @endif
        </li>
        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
            @if($privacy)
                <a href="{{ route('privacy') }}" target="_blank"
                   class="no-underline hover:underline text-gray-800 hover:text-pink-500">Privacy
                </a>
            @endif
        </li>
    </ul>
</div>
