<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/board','boardController@index');
$router->post('/board','boardController@store');
$router->put('/board/{boardId}','boardController@update');
$router->delete('/board/{id}','boardController@destory');
$router->get('/board/{boardId}','boardController@show');

$router->post('/user','userController@store');
$router->post('/login','userController@login');
$router->get('/logout','userController@logout');