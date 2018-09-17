<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:16
 */
return [
    'zend-db' => [
        'mssql' => [
            'hostname' => "localhost",
            'username' => "sa",
            'password' => "#LeNtilla1",
            'database' => "Film",
            'driver' => "sqlsrv",
            'charset' => "UTF-8"
        ],
        'mongo' => [
            'hostname' => "localhost",
            'database' => "cinema",
            'port' => 27017,
            'dsn' => "mongodb://localhost:27017"
        ]
    ],
    'db' => [
        'hostname' => "localhost",
        'username' => "sa",
        'password' => "#LeNtilla1",
        'database' => "Film",
        'driver' => "sqlsrv",
        'charset' => "UTF-8"
    ]
];