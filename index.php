<?php 


require_once( 'inc/config.php' );
$routes = [

    '/'     => [
        'GET' => 'home.php'
    ],
    '/edit' => [
        'GET'   => 'edit.php',
        'POST'  => 'inc/post-edit.php'
    ],
    '/delete' => [
        'GET'   => 'delete.php',
        'POST'  => 'inc/post-delete.php'
    ],
    '/post'   => [
        'GET'   => 'post.php',
        'POST'  => 'inc/post-add.php'
    ]
];


$page = segment( 1 );
$request_method = $_SERVER['REQUEST_METHOD'];

if( ! isset( $routes["/$page"][$request_method] ) ) {
    show_404();
}

$file = $routes["/$page"][$request_method];
require( $file );


?>