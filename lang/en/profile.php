<?php

return [
    'info' => [
        'name' => 'Name',
        'email' => 'Email',
        'invited_people' => 'Invited People',
        'all_time_votes' => 'All Time Votes',
        'max_votes_per_day' => 'Max Votes Per Day',
        'weight_of_individual_vote' => 'Weight of Individual Vote',
    ],

    'theme_selection' => [
        'title' => 'Theme selection',
        'text' => 'Choose your preferred theme for the website.',
        'light' => 'Light',
        'dark' => 'Dark',
        'system' => 'System Default',
    ],

    'invite_link' => [
        'title' => 'Your invite link',
        'text' => 'Share this link with your friends to join Radio Ostrov. Each new user that registers using this link will provide you with extra benefits.',
        'copy_link' => 'Copy link',
    ],

    'reward_system' => [
        'title' => 'Reward to claim',
        'text' => 'By reaching certain levels in our reward system, you will earn special benefits. Don\'t forget to claim them!',
        'card' => [
            'level' => 'Level :level',
            'max_level' => 'Max Level',
            'text' => 'Earn :points more points for Level :level!',
            'reward' => 'Reward',
            'claim' => 'Claim',
            'points' => '{0} points|{1} point|[2,*] points',
        ],
    ],

    'favorite_songs' => [
        'title' => 'Your favorite songs',
        'text' => [
            'main' => 'These songs will be used when selecting tracks for voting. Winning songs from the voting will then be played during the big break.',
            'waiting' => 'Waiting for admin approval',
            'approved' => 'Approved by admin',
            'rejected' => 'Rejected by admin (Rejected song is probably explicit or longer than 6 minutes)',
        ],
        'song' => 'song',
        'save_changes' => 'Save changes',
    ],

    'delete_account' => [
        'title' => 'Delete account',
        'text' => 'After deleting your account, all its resources and data will be permanently deleted.',
        'delete' => 'Delete account',
        'confirm_delete' => [
            'title' => 'Are you sure you want to delete your account?',
            'text' => 'After deleting your account, all its resources and data will be permanently deleted.',
            'cancel' => 'Cancel',
            'delete' => 'Delete account',
        ],
    ],
];
