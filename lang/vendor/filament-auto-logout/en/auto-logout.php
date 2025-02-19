<?php

return [
    'notification' => [
        'title' => 'Your session is about to expire',
        // The notification body will replace :timeleft: with the actual timeleft.
        // Feel free to remove it if you don't want to show it.
        'body' => 'You will be logged out in :timeleft:',
    ],

    'units' => [
        'seconds' => [
            'short' => 's',
            'long' => 'seconds',
        ],
        'minutes' => [
            'short' => 'm',
            'long' => 'minutes',
        ],
        'hours' => [
            'short' => 'h',
            'long' => 'hours',
        ],
    ],
];
