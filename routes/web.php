<?php


Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(
    [
        'prefix' => '{locale}',
        'where'  => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => 'setlocale'
    ],
    function() {

        Auth::routes();

        Route::get('/', 'HomeController@index')->name('home');

        Route::resources(
            [
                'users' => 'UserController',
                'sections' => 'SectionController'
            ]
        );
    }
);
