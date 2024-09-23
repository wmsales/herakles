<?php 

$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/setup', 'App\Controllers\ConfigController@index');
$router->post('/setup', 'App\Controllers\ConfigController@apply_config');

?>