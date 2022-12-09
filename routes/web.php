<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/register', ['uses' => 'AuthController@register']);
    $router->post('/login', ['uses' => 'AuthController@login']);
});
$router->put('/home/{matkulid}', ['middleware' => 'auth', 'uses' => 'HomeController@home']);
//$router->put('/mahasiswa/{id}', ['middleware' => 'auth', 'uses' => 'MahasiswaController@tambahMatkul']);

$router->group(['prefix' => 'prodi'], function () use ($router) {
    $router->get('/',     ['uses' => 'ProdiController@getProdi']);
    $router->post('/add', ['uses' => 'ProdiController@createProdi']);
    $router->get('/{id}', ['uses' => 'ProdiController@oneProdi']);
});

$router->group(['prefix' => 'mahasiswa'], function () use ($router) {
    $router->post('/{nim}/matakuliah/{mkId}', ['middleware' => 'auth', 'uses' => 'MahasiswaController@tambahMatKul']);
    $router->put('/{nim}/matakuliah/{mkId}', ['middleware' => 'auth', 'uses' => 'MahasiswaController@hapusMatKul']);
    $router->get('/',        ['uses' => 'MahasiswaController@getMahasiswa']);
    $router->get('/profile', ['uses' => 'MahasiswaController@getMahasiswa']);
    $router->get('/{nim}',   ['uses' => 'MahasiswaController@getByNim']);
});

$router->group(['prefix' => 'matakuliah'], function () use ($router) {
    $router->get('/',     ['uses' => 'MataKuliahController@getMataKuliah']);
    $router->post('/add', ['uses' => 'MataKuliahController@createMataKuliah']);
});

