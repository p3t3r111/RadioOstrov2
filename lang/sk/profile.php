<?php

return [
    'info' => [
        'name' => 'Meno',
        'email' => 'Email',
        'invited_people' => 'Pozvaní ľudia',
        'all_time_votes' => 'Celkový počet hlasov',
        'max_votes_per_day' => 'Maximálny počet hlasov za deň',
        'weight_of_individual_vote' => 'Váha jednotlivého hlasu',

        'all_time_points' => 'Celkový počet bodov',
        'all_time_points_description' => 'Celkový počet bodov, ktoré ste získali hlasovaním a pozváním ľudí. (Za každý hlas získate :each_vote bodov a za každého pozvaného človeka získate :each_invite bodov)',

        'reserved_points' => 'Rezervované body',
        'reserved_points_description' => 'Body, ktoré sú pre vás rezervované a budú pridané k vašim celkovým bodom, keď dnešné hlasovanie skončí. (Rezervované body sú vypočítávané na základe dnešných hlasov)',

        'unused_points' => 'Nevyužité body',
        'unused_points_description' => 'Body, ktoré máte k dispozici pre použitie na získanie odmien.',

        'used_points' => 'Použité body',
        'used_points_description' => 'Body, ktoré ste už použili na získanie odmien.',
    ],

    'theme_selection' => [
        'title' => 'Výber motivu',
        'text' => 'Vyberte svoj preferovaný motiv pre webovú stránku.',
        'light' => 'Svetlý',
        'dark' => 'Tmavý',
        'system' => 'Predvolené nastavenie systému',
    ],

    'invite_link' => [
        'title' => 'Váš pozývací odkaz',
        'text' => 'Zdieľajte tento odkaz s priateľmi, aby sa mohli pripojiť k Rádio ostrov. Každý nový používateľ, ktorý sa zaregistruje pomocou tohto odkazu, vám poskytne extra výhody.',
        'copy_link' => 'Kopírovať odkaz',
    ],

    'reward_system' => [
        'title' => 'Odmeny k vyzdvihnutiu',
        'text' => 'Za dosiahnutie určitých úrovní v našom odmeňovacom systéme získate špeciálne výhody. Nezabudnite si ich vyzdvihnúť!',
        'card' => [
            'level' => 'Úroveň :level',
            'max_level' => 'Maximálna úroveň',
            'text' => 'Získaj ešte :points body pre úroveň :level!',
            'ready_to_claim' => 'K vyzdvihnutiu',
            'reward' => 'Odmena',
            'claim' => 'Vyzdvihnúť',
            'points' => '{0} bodov|{1} bod|[2,4] body|[5,*] bodov',
        ],
    ],

    'favorite_songs' => [
        'title' => 'Tvoje obľúbené písničky',
        'text' => [
            'main' => 'Tieto pesničky budú použité pri výbere skladieb do hlasovania. Víťazné pesničky z hlasovania sa následne budú prehrávať cez veľkú prestávku.',
            'waiting' => 'Čaká sa na schválenie administrátorom',
            'approved' => 'Schválené administrátorom',
            'rejected' => 'Zamietnuté administrátorom (Zamietnutá pesnička pravdepodobne = explicitná alebo dlhšia ako 6 minút)',
        ],
        'song' => 'pesnička',
        'save_changes' => 'Uložiť zmeny',
    ],

    'delete_account' => [
        'title' => 'Vymazať účet',
        'text' => 'Po vymazaní vášho konta budú všetky jeho zdroje a údaje natrvalo vymazané.',
        'delete' => 'Vymazať účet',
        'confirm_delete' => [
            'title' => 'Určite chcete vymazať svoje konto?',
            'text' => 'Po vymazaní vášho konta budú všetky jeho zdroje a údaje natrvalo vymazané.',
            'cancel' => 'Zrušiť',
            'delete' => 'Vymazať účet',
        ],
    ],
];
