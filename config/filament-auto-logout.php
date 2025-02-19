<?php

use Carbon\Carbon;
use Filament\View\PanelsRenderHook;

return [
    /**
     * Disable or enable the plugin
     */
    'enabled' => env('FILAMENT_AUTO_LOGOUT_ENABLED', true),

    /**
     * The duration in seconds your users can be idle before being logged out.
     *
     * The duration needs to be specified in seconds.
     *
     * A sensible default has been set to 15 minutes
     */
    'duration_in_seconds' => env('FILAMENT_AUTO_LOGOUT_DURATION_IN_SECONDS', Carbon::SECONDS_PER_MINUTE * 15),

    /**
     * A notification will be sent to the user before logging out.
     *
     * This sets the seconds BEFORE sending out the notification.
     */
    'warn_before_in_seconds' => env('FILAMENT_AUTO_LOGOUT_WARN_BEFORE_IN_SECONDS', 30),

    /**
     * The plugin comes with a small time left box which will display the time left
     * before the user will be logged out.
     */
    'show_time_left' => env('FILAMENT_AUTO_LOGOUT_SHOW_TIME_LEFT', true),

    /**
     * What should the time left box display before the timer?
     *
     * A default has been set to 'Time left:'
     */
    'time_left_text' => env('FILAMENT_AUTO_LOGOUT_TIME_LEFT_TEXT', 'Time left:'),

    /**
     * Where should the badge be rendered?
     *
     * @see https://filamentphp.com/docs/3.x/support/render-hooks#available-render-hooks for a list of supported hooks.
     */
    'location' => env('FILAMENT_AUTO_LOGOUT_LOCATION', PanelsRenderHook::GLOBAL_SEARCH_BEFORE),
];
