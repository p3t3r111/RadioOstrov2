<?php

return [
    'info' => [
        'name' => 'Név',
        'email' => 'E-mail',
        'invited_people' => 'Meghívott személyek',
        'all_time_votes' => 'Összes szavazat',
        'max_votes_per_day' => 'Napi maximális szavazatszám',
        'weight_of_individual_vote' => 'Egyéni szavazat súlya',

        'all_time_points' => 'Összes pont',
        'all_time_points_description' => 'Az összes pont, amelyet szavazással és meghívásokkal szereztél. (Minden szavazatért :each_vote pontot kapsz, és minden meghívott személy után :each_invite pontot kapsz)',

        'reserved_points' => 'Foglalt pontok',
        'reserved_points_description' => 'Azok a pontok, amelyek jelenleg foglalva vannak, és a mai szavazás lezárása után hozzáadódnak az összes pontodhoz. (A foglalt pontok a mai szavazatok alapján kerülnek kiszámításra)',

        'unused_points' => 'Felhasználatlan pontok',
        'unused_points_description' => 'Azok a pontok, amelyeket még felhasználhatsz jutalmak igénylésére.',

        'used_points' => 'Felhasznált pontok',
        'used_points_description' => 'Azok a pontok, amelyeket már felhasználtál jutalmak igénylésére.',
    ],

    'theme_selection' => [
        'title' => 'Téma kiválasztása',
        'text' => 'Válaszd ki a kívánt témát a weboldalhoz.',
        'light' => 'Világos mód',
        'dark' => 'Sötét mód',
        'system' => 'Rendszer alapértelmezése',
    ],

    'invite_link' => [
        'title' => 'A meghívó linked',
        'text' => 'Oszd meg ezt a hivatkozást a barátaiddal, hogy csatlakozhassanak a Rádió Ostrovhoz. Minden új felhasználó, aki ezen a linken keresztül regisztrál, extra előnyöket biztosít neked.',
        'copy_link' => 'Hivatkozás másolása',
    ],

    'reward_system' => [
        'title' => 'Átvehető jutalmak',
        'text' => 'Bizonyos szintek elérésével a jutalmazási rendszerünkben különleges előnyöket kapsz. Ne felejtsd el átvenni őket!',
        'card' => [
            'level' => ':level. szint',
            'max_level' => 'Maximális szint',
            'text' => 'Szerezz még :points pontot a(z) :level. szinthez!',
            'reward' => 'Jutalom',
            'claim' => 'Átvétel',
            'points' => '{0} pont|{1} pont|[2,4] pont|[5,*] pont',
        ],
    ],

    'favorite_songs' => [
        'title' => 'Kedvenc dalaid',
        'text' => [
            'main' => 'Ezek a dalok a szavazásra kerülő dalok kiválasztásánál lesznek felhasználva. A szavazás nyertes dalai ezután a nagyszünetben kerülnek lejátszásra.',
            'waiting' => 'Adminisztrátori jóváhagyásra vár',
            'approved' => 'Adminisztrátor által jóváhagyva',
            'rejected' => 'Adminisztrátor által elutasítva (az elutasított dal valószínűleg explicit vagy hosszabb mint 6 perc)',
        ],
        'song' => 'dal',
        'save_changes' => 'Változtatások mentése',
    ],

    'delete_account' => [
        'title' => 'Fiók törlése',
        'text' => 'A fiók törlése után az összes erőforrása és adata véglegesen törlésre kerül.',
        'delete' => 'Fiók törlése',
        'confirm_delete' => [
            'title' => 'Biztosan törölni szeretnéd a fiókodat?',
            'text' => 'A fiók törlése után az összes erőforrása és adata véglegesen törlésre kerül.',
            'cancel' => 'Mégse',
            'delete' => 'Fiók törlése',
        ],
    ],
];
