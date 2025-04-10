<x-filament-widgets::widget>
    <x-filament::section
            :heading="$heading"
            :description="$description"
    >
        @if($dependencies->isNotEmpty())
            <div class="flex justify-between py-2">
                <div class="text-sm text-gray-600 dark:text-white font-bold">
                  {{ __('filament-system-versions::system-versions.widgets.dependency.table.name') }}
                </div>
                <div class="text-sm text-gray-500 dark:text-white font-bold">
                    {{ __('filament-system-versions::system-versions.widgets.dependency.table.version') }}
                </div>
            </div>
          @foreach($dependencies as $dependency)
                <div class="flex justify-between py-2">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <a href="https://packagist.org/packages/{{ $dependency->name }}" target="_blank" class="hover:text-primary-600 hover:underline">
                            {{ $dependency->name }}
                        </a>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 flex gap-2">
                        <x-filament::badge color="warning">{{ $dependency->current_version }} > {{ $dependency->latest_version }}</x-filament::badge>
                    </div>
                </div>
          @endforeach
        @else
            <div class="fi-ta-empty-state-content mx-auto grid max-w-lg justify-items-center text-center">
                <div class="fi-ta-empty-state-icon-ctn mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                    <x-filament::icon
                            icon="heroicon-o-check-circle"
                            class="fi-ta-empty-state-icon h-6 w-6 text-primary-600 dark:text-primary-600"
                    />
                </div>

                <p class="fi-ta-empty-state-description text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('filament-system-versions::system-versions.widgets.dependency.empty') }}
                </p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
