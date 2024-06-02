<?php

/**
 * List of authorized roles and emails.
 *
 * Authorized roles have specific abilities:
 *  - Admin: Create, Read, Update, and Delete
 *  - Manager: Create, Read, and Update
 *
 * Do not add `user` here.
 *
 * For specific people add their emails at 'emails'
 */
return [
    'roles' => [
        'admin',
        'manager',
    ],
    'emails' => [
        'ines.mineiro@roboplan.pt',
        'douglascnlobo@icloud.com',
    ]
];

