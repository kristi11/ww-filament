<?php

return [
    'notification' => [
        'title' => 'Sesiunea curenta expiră în curând',
        // Poti folosi :timeleft: in continutul notificarii.
        // Va fi inlocuit cu durata pana la deconectare.
        'body' => 'Vei fi deconectat în :timeleft:',
    ],

    'units' => [
        'seconds' => [
            'short' => 'sec',
            'long' => 'secunde',
        ],
        'minutes' => [
            'short' => 'min',
            'long' => 'minute',
        ],
        'hours' => [
            'short' => 'h',
            'long' => 'ore',
        ],
    ],
];
