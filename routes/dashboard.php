<?php

use App\Http\Controllers\Dashboard\BannerController;
use Illuminate\Support\Facades\Route;

Route::controller('AuthController')->name('auth.')->group(function () {

    Route::get('login', 'login')->name('login');

    Route::post('login-process', 'loginProcess')->name('login-process');

    Route::get('logout', 'logout')->name('logout');

});

Route::middleware('isPassAdmin')->group(function () {

    Route::controller('HomeController')->name('home.')->group(function () {

        Route::get('/', 'index')->name('index');

    });

    Route::controller('UserController')->prefix('users')->name('users.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('show/{user}', 'show')->name('show');

        Route::get('edit/{user}', 'edit')->name('edit');

        Route::put('update/{user}', 'update')->name('update');

    });

    Route::controller('TeamController')->prefix('teams')->name('teams.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('show/{channel}', 'show')->name('show');

    });

    Route::controller('CommunityController')->prefix('communities')->name('communities.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('show/{channel}', 'show')->name('show');

    });

    Route::controller('SubCommunityController')->prefix('sub-communities')->name('sub-communities.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('show/{channel}', 'show')->name('show');

    });

    Route::controller('PlanController')->prefix('plans')->name('plans.')->group(function () {

        Route::get('/', 'index')->name('index');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::get('edit/{plan}', 'edit')->name('edit');

        Route::delete('delete/{plan}', 'destroy')->name('delete');

        Route::put('update/{plan}', 'update')->name('update');

    });

    Route::controller('SubscriptionController')->prefix('subscriptions')->name('subscriptions.')->group(function () {

        Route::get('/', 'index')->name('index');

    });

    Route::controller('SettingController')->prefix('settings')->name('settings.')->group(function () {

        Route::get('edit', 'edit')->name('edit');

        Route::put('update', 'update')->name('update');

    });

    Route::controller('LibraryController')->prefix('library')->name('library.')->group(function () {

        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::get('edit/{library}', 'edit')->name('edit');

        Route::put('update/{library}', 'update')->name('update');

        Route::delete('delete/{library}', 'destroy')->name('delete');

        Route::controller('LibrarySectionController')->prefix('sections')->name('sections.')->group(function () {

            Route::get('/', 'index')->name('index');

            Route::get('create', 'create')->name('create');

            Route::post('store', 'store')->name('store');

            Route::get('edit/{librarySection}', 'edit')->name('edit');

            Route::put('update/{librarySection}', 'update')->name('update');

        });

    });
    Route::controller('BannerController')->prefix('banners')->name('banners.')->group(function () {

        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::get('edit/{banner}', 'edit')->name('edit');

        Route::put('update/{banner}', 'update')->name('update');

        Route::delete('delete/{banner}', 'destroy')->name('delete');
    });
    Route::controller('HomeBannerController')->prefix('HomeBanners')->name('HomeBanners.')->group(function () {

        Route::get('index', 'index')->name('index');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::get('edit/{banner}', 'edit')->name('edit');

        Route::put('update/{banner}', 'update')->name('update');

        Route::delete('delete/{banner}', 'destroy')->name('delete');
    });
    Route::controller('TransactionController')->prefix('transactions')->name('transactions.')->group(function () {

        Route::get('/', 'index')->name('index');

    });

});
