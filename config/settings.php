<?php

return [
    'init_users' => [
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => env('ADMIN_PASS'),
            'role' => ROLE_ADMIN
        ]
    ],

];