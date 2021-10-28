<?php

return [
    'role_structure' => [
        'super' => [
            'users'      => 'c,r,u,d',
            'types'      => 'c,r,u,d',
            'branches'   => 'c,r,u,d',
            'rooms'      => 'c,r,u,d',
            'features'   => 'c,r,u,d',
            'reservations'   => 'c,r,u,d',
        ],
        // 'admin' => [
        //     'users'      => 'c,r,u,d',
        // ],
        // 'user' => [
        //     'users'      => 'c,r,u,d',
        // ],
        'new_per' => [],
    ],
    // 'permission_structure' => [
    //     'cru_user' => [
    //         'profile' => 'c,r,u'
    //     ],
    // ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
