<?php

use GuzzleHttp\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://swapi.dev/api/',
        // You can set any number of default request options.
        'timeout'  => 0.0,
    ]);

    //CAPTAMOS
    for($x=1; $x<=4; $x++){
        $response = $client->request('GET', 'starships/?page='.$x.'&format=json'); //starships y people

        $data = json_decode($response->getBody()->getContents());
        
        for($i=0; $i < sizeof($data->results);$i++){
            $starship[] = $data->results[$i]->name;
        }
    }
    dd($data);

    //dd($response->getBody()->getContents('results'));
    //return json_decode($response->getBody()->getContents());
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas para la swapi
Route::get('post','SpaceShips@postRequest')->name('ship.post');
Route::get('get','SpaceShips@getRequest')->name('ship.get');


