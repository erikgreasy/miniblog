<?php

require_once( 'functions.php' );



// CONSTANTS
define( 'BASE_URL', 'http://miniblog.test' );
define( 'APP_PATH', realpath( __DIR__ . '/../' ) );

$config_var = [
    'db' => [
        'type' => 'mysql',
        'host' => 'localhost',
        'name' => 'miniblog',
        'user' => 'root',
        'password' => ''
    ]
];



// ==========================================================================================================
//                  DATABASE              
// ==========================================================================================================

// CONNECT TO DB
$db = new PDO(
    "{$config_var['db']['type']}:host={$config_var['db']['host']};dbname={$config_var['db']['name']}", 
    $config_var['db']['user'], 
    $config_var['db']['password']
);

// SET ERROR MODE FOR DB
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// DISABLE PREPARATION FOR OLD VERSIONS OF DB
$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );




