<?php
return array(

    'app' => array(
        'url'  => 'http://localhost',
        'hash' => array(
            'algo' => PASSWORD_BCRYPT,
            'cost' => 10
        )
    ),

    'db' => array(
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'name'      => 'auth',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => ''
    ),

    'auth' => array(
        'session'  => 'user_id',
        'remember' => 'user_r'
    ),

    'mail' => array(
        'smtp_auth'   => true,
        'smtp_secure' => 'tls',
        'host'        => 'smtp.gmail.com',
        'username'    => 'FvsJ101@gmail.com',
        'password'    => 'ralfisdom',
        'port'        => 587,
        'html'        => true
    ),

    'twig' => array(
        'debug'       => true,
    ),

    'csrf' => array(
        'key' => 'csrf_token'
    )
);