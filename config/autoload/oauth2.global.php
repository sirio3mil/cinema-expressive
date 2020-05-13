<?php

use League\OAuth2\Server\Grant;

return [
    'authentication' => [
        'private_key' => '',
        'public_key' => '',
        'encryption_key' => '',
        'access_token_expire' => 'P1M',
        'refresh_token_expire' => 'P1M',
        'auth_code_expire' => 'PT10M',
        'pdo' => [
            'dsn' => '',
            'username' => '',
            'password' => ''
        ],

        // Set value to null to disable a grant
        'grants' => [
            Grant\ClientCredentialsGrant::class => null,
            Grant\PasswordGrant::class => Grant\PasswordGrant::class,
            Grant\AuthCodeGrant::class => null,
            Grant\ImplicitGrant::class => null,
            Grant\RefreshTokenGrant::class => null
        ]
    ]
];
