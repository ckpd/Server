<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('/products','ProductController');
Route::apiResource('/profiles','ProfileController');

// Route::group(['middleware' => ['api','cors']], function () {
//     Route::post('auth/register', 'AuthController@signup');
//     Route::post('auth/login', 'AuthController@login');
// });


Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
