<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', function () {
        return view('index');
    });

    // Gets main page for lorem ipsum
    Route::get('/lorem-ipsum', 'LoremIpsumController@getIndex');
    // Posts for submitting the lorem ipsum generator form
    Route::post('/lorem-ipsum', 'LoremIpsumController@postGenerate');

    // Gets main page for random user generator
    Route::get('/user-generator', 'UserGeneratorController@getIndex');
    // Posts for submitting the random user generator form
    Route::post('/user-generator', 'UserGeneratorController@postGenerate');

    // Gets main page for password generator
    Route::get('/password-generator', 'PasswordGeneratorController@getIndex');
    // Posts for submitting the password generator form
    Route::post('/password-generator', 'PasswordGeneratorController@postGenerate');
});
