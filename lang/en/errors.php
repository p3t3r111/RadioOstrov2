<?php

return [
    'return_home' => 'Return to Home',
    '401' => [
        'title' => 'Unauthorized Access',
        // Pre prístup k tejto stránke sa musíte prihlásiť.
        'message' => 'You must be logged in to access this page.',
        // Prosím, prihláste sa a skúste to znova.
        'suggestion' => 'Please log in and try again.',
        // Prihlásiť sa
        'login' => 'Login',
    ],

    '403' => [
        'title' => 'Forbidden',
        // Nemáte oprávnění k přístupu na tuto stránku.
        'message' => 'You do not have permission to access this page.',
        // Pokud si myslíte, že byste měli mít přístup, kontaktujte správce.
        'suggestion' => 'If you believe you should have access, please contact the administrator.',
    ],

    '404' => [
        'title' => 'Page Not Found',
        // Omlouváme se, ale požadovaná stránka nebyla nalezena.
        'message' => 'Sorry, the page you are looking for could not be found.',
        // Zkontrolujte URL nebo se vraťte na domovskou stránku.
        'suggestion' => 'Please check the URL or return to the homepage.',
    ],

    '500' => [
        'title' => 'Internal Server Error',
        // Omlouváme se, ale došlo k chybě na serveru.
        'message' => 'Sorry, an error occurred on the server.',
        // Zkuste to znovu později nebo kontaktujte podporu.
        'suggestion' => 'Please try again later or contact support.',
    ],
];
