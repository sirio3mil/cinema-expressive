<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 20/07/2018
 * Time: 9:16
 */
return [
    'db' => [
        'mssql' => [
            'hostname' => "mssql",
            'username' => "sa",
            'password' => "ms3CjP{R?1^A",
            'database' => "Film",
            'driver' => "sqlsrv",
            'charset' => "UTF-8"
        ],
        'neo4j' => [
            'hostname' => "neo4j",
            'username' => "neo4j",
            'password' => "testing",
            'driver' => "bolt",
            "port" => 7687
        ],
        'mongo' => [
            'hostname' => "mongo",
            'database' => "cinema",
            'port' => 27017
        ],
        'mysql' => [
            'hostname' => "mssql",
            'username' => "root",
            'password' => "ms3CjP{R?1^A",
            'database' => "Film",
            'driver' => "mysqli",
            'charset' => "utf8"
        ],
    ]
];