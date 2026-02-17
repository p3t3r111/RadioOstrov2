<?php

return [
    'return_home' => 'Vissza a főoldalra',
    '401' => [
        'title' => 'Nincs jogosultság',
        'message' => 'A oldal eléréséhez be kell jelentkeznie.',
        'suggestion' => 'Kérjük, jelentkezzen be, és próbálja meg újra.',
        'login' => 'Bejelentkezés',
    ],

    '403' => [
        'title' => 'Hozzáférés megtagadva',
        'message' => 'Nincs jogosultsága ennek az oldalnak az eléréséhez.',
        'suggestion' => 'Ha úgy gondolja, hogy kellene hozzáférése, lépjen kapcsolatba a rendszergazdával.',
    ],

    '404' => [
        'title' => 'Az oldal nem található',
        'message' => 'Sajnáljuk, de a kért oldal nem található.',
        'suggestion' => 'Ellenőrizze az URL-t, vagy térjen vissza a főoldalra.',
    ],

    '500' => [
        'title' => 'Belső szerverhiba',
        'message' => 'Sajnáljuk, de hiba történt a szerveren.',
        'suggestion' => 'Próbálja meg később újra, vagy lépjen kapcsolatba az ügyfélszolgálattal.',
    ],
];
