<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use Iliuminates\FrameworkSettings;
use Iliuminates\Locales\Lang;
use Iliuminates\Router\Route;
use Iliuminates\Sessions\session;

Route::get('/', HomeController::class, 'index');
Route::get('/data', HomeController::class, 'data');
Route::post('/send/data', HomeController::class, 'data_post');

// Route::get('/', fn()=>"hello anonymous function");

// Route::get('/', function () {
//     // FrameworkSettings::setLocale('en');
//     // return trans('main.hello',['name'=>'ahmed']);
//     return view('index');
// });

// Route::group(['prefix'=>'site'],function(){
//     Route::get('/about', HomeController::class, 'about');
//     // Route::get('/article/{id}', HomeController::class, 'article');
//     Route::get('/article/{id}', function ($id) {
//         return $id;
//     });
// });
