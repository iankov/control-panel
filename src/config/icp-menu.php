<?php

if(empty($fromIcpServiceProvider)){
    return [];
}

return [
    /*
     * If true, all menu groups are visible if not stated other. If false, all menu groups are invisible if not stated other.
     * To make group visible or invisible, add 'visible' => true/false value
     */
    'default-group-visibility' => true,

    /*
     * If true, all menu items are visible if not stated other. If false, all menu items are invisible if not stated other.
     * To make item visible or invisible, add 'visible' => true/false value
     */
    'default-item-visibility' => true,

    'groups' => [
        'basic' => [
            //'visible' => true,
            'title' => 'Basic',
            'icon' => 'bars',
            'items' => [
                'admins' => [
                    //'visible' => true,
                    'icon' => 'user-circle',
                    'title' => 'Admins',
                    'link' => icp_route('admins')
                ],
                'settings' => [
                    //'visible' => true,
                    'icon' => 'gear',
                    'title' => 'Settings',
                    'link' => icp_route('settings')
                ],
                'file-manager' => [
                    //'visible' => true,
                    'icon' => 'folder',
                    'title' => 'File Manager',
                    'link' => icp_route('file-manager')
                ],
            ]
        ],

        'other' => [
            //'visible' => true,
            'title' => 'Other',
            'icon' => 'folder',
            'items' => [

            ]
        ],
    ]
];