<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'middleware' => 'api',
        'prefix'     => 'auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout')->name('login');
        Route::post('refresh', 'AuthController@refresh');
    }
);

Route::group(
    [
        'middleware' => ['api', 'cors'],
        'prefix'     => 'employees',
    ],
    function ($router) {
        Route::get('get-all', 'EmployeeController@getAllEmployee');
    }
);

Route::group(
    [
        'middleware' => ['api', 'cors'],
        'prefix'     => 'departments',
    ],
    function ($router) {
        Route::get('get-all', 'DepartmentController@getAllDepartment');
    }
);



