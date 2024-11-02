<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;
use App\Http\Middleware\UserMiddleware;
use Iliuminates\FrameworkSettings;
use Iliuminates\Router\Route;
use Iliuminates\Sessions\session;

Route::group(['prefix' => 'api', 'middlewares' => [SimpleMiddleware::class]], function () {
    Route::get('/', function () {
        return FrameworkSettings::getLocale();
        // return session::get('locale');
    });
    Route::get('users', function () {
        return 'welcome to api users';
    }, [UserMiddleware::class]);
    Route::get('any', HomeController::class, 'api_any', [UserMiddleware::class]);
});
