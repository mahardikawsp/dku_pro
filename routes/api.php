<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user'    => 'API\UserController',
                    'position' => 'API\PositionController',
                    'leader'   => 'API\LeaderController',
                    'location' => 'API\LocationController',
                    'status'   => 'API\StatusController',
                    'absent'   => 'API\AbsentController',
                    'sellthrough' => 'API\SellthroughController',
                    'outlet'   => 'API\OutletController',
                    'jamker'   => 'API\JamkerController',
                    'ijin'     => 'API\ReasonController']);
                    
Route::get('profile','API\UserController@profile');

Route::get('findUser','API\UserController@search');
Route::get('findUserIjin','API\ReasonController@search');
Route::get('findPosition','API\PositionController@search');

Route::get('uabsent','API\AbsentController@uabsent');
Route::put('profile','API\UserController@updateProfile');

Route::post('login', 'Android\AndroidController@login');
Route::post('register', 'Android\AndroidController@register');
Route::get('getuser/{id}', 'Android\AndroidController@detailUsers');
Route::post('checkin', 'Android\CheckinController@store');
Route::post('checkout', 'Android\CheckoutController@store');
Route::get('useronly', 'API\UserController@joinwp');

Route::post('reason', 'Android\ReasonController@store');
Route::get('getleader/{id}', 'Android\ReasonController@show');
Route::post('approve', 'Android\ReasonController@approve');


//sellthrought

Route::post('uploadsell', 'API\SellthroughController@store');
Route::post('upoutlet', 'API\OutletController@store');
Route::post('usellorder', 'API\SellorderController@store');
Route::post('udisota', 'API\DisotaController@store');

Route::get('export', 'API\AbsentController@exportData');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});