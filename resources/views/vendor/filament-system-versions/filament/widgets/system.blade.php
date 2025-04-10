<x-filament-widgets::widget>
    <x-filament::section
            :heading="$heading"
            :description="$description"
    >
        @foreach($details as $key => $value)
            <div class="flex justify-between py-2">
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $key }}</div>
                <div class="text-sm text-gray-500 dark:text-white">{{ $value }}</div>
            </div>
        @endforeach
    </x-filament::section>
</x-filament-widgets::widget>
