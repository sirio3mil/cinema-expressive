<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 18/07/2018
 * Time: 23:01
 */

declare(strict_types=1);

return [
    'zend-cache' => [
        'adapter' => [
            'name' => 'memcached',
            'options' => [
                'ttl' => 360000,
                'namespace' => 'cache_listener',
                'key_pattern' => null,
                'readable' => true,
                'writable' => true,
                'servers' => ['127.0.0.1'],
            ],
        ],
        'plugins' => [
            'exception_handler' => ['throw_exceptions' => false],
        ],
    ],
];
