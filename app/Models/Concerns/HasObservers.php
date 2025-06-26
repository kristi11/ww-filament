<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

/**
 * Trait HasObservers
 *
 * This trait provides a method to get the observers registered for a model.
 */
trait HasObservers
{
    /**
     * Get the observers registered for this model.
     *
     * @return array
     */
    public static function getObservers()
    {
        $listeners = app('events')->getRawListeners();

        // Filter listeners to only include those for this model
        $modelListeners = array_filter($listeners, function ($key) {
            return Str::startsWith($key, 'eloquent.') && Str::endsWith($key, static::class);
        }, ARRAY_FILTER_USE_KEY);

        // Extract observer class names from listeners
        $observers = [];
        foreach ($modelListeners as $listeners) {
            foreach ($listeners as $listener) {
                if (is_string($listener)) {
                    // Format is 'ObserverClass@method'
                    $observerClass = Str::before($listener, '@');
                    if (! in_array($observerClass, $observers)) {
                        $observers[] = $observerClass;
                    }
                }
            }
        }

        return $observers;
    }
}
