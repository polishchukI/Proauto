<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        //system
        'system' => [
            'driver'			=> env('DB_CONNECTION_SYSTEM', 'mysql'),
            'host'				=> env('DB_HOST_SYSTEM', '127.0.0.1'),
            'port'				=> env('DB_PORT_SYSTEM', '3306'),
            'database'			=> env('DB_DATABASE_SYSTEM', 'system'),
            'username'			=> env('DB_USERNAME_SYSTEM', 'root'),
            'password'			=> env('DB_PASSWORD_SYSTEM', 'root'),
            'charset'			=> 'utf8',
            'collation'			=> 'utf8_general_ci',
            'prefix'			=> '',
            'prefix_indexes'	=> true,
            'strict'			=> true,
            'engine'			=> null,
            'options'			=> extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        //TD база
        'catalog' => [
            'driver'			=> env('DB_CONNECTION_TD', 'mysql'),
            'host'				=> env('DB_HOST_TD', '127.0.0.1'),
            'port'				=> env('DB_PORT_TD', '3306'),
            'database'			=> env('DB_DATABASE_TD', 'td2018'),
            'username'			=> env('DB_USERNAME_TD', 'root'),
            'password'			=> env('DB_PASSWORD_TD', 'root'),
            'unix_socket'		=> env('DB_SOCKET', ''),
            'charset'			=> 'utf8',
            'collation'			=> 'utf8_general_ci',
            'prefix'			=> '',
            'prefix_indexes'	=> true,
            'strict'			=> true,
            'engine'			=> null,
            'options'			=> extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
