<?php

use Illuminate\Support\Facades\Route;

Route::controller('AuthController')->group(function () {

    Route::post('register', 'register')->name('register');

    Route::post('login', 'login')->name('login');

    Route::post('forgot-password', 'forgotPassword')->name('forgot-password');

    Route::post('deleteaccount/{id}', 'deleteaccount')->name('deleteaccount');

    Route::post('change-password', 'changePassword')->name('change-password');

    Route::name('otp.')->prefix('otp')->group(function () {

        Route::post('verify', 'verifyOtp')->name('verify');

        Route::post('resend', 'resendOtp')->name('resend');

    });

});

Route::middleware(['auth:sanctum', 'isPass'])->group(function () {

    Route::name('channels.')->prefix('channels')->group(function () {

        Route::controller('ChannelController')->group(function () {

            Route::post('store', 'store')->name('store')->middleware('canAddChannel');

            Route::get('show/{channel}', 'show')->name('show');

            Route::post('update/{channel}', 'update')->name('update');

            Route::delete('delete/{channel}', 'destroy')->name('delete');

            Route::post('archive', 'archive')->name('archive');

            Route::post('duplicate', 'duplicate')->name('duplicate');

            Route::get('moderators-guests/{channel}', 'getModeratorsGuests')->name('moderators-guests.get');

            Route::get('authenticateJoined', 'getAuthenticatedJoined')->name('authenticated-joined.all');

        });

        Route::controller('ChannelUserController')->name('users.')->prefix('users')->group(function () {

            Route::get('admin', 'getAdminChannels')->name('admin.get');

            Route::get('joined', 'getJoinedChannels')->name('joined.get');

            Route::get('archived', 'getArchivedChannels')->name('archived.get');

            Route::post('forward', 'forward')->name('forward');

            Route::get('chats/recent', 'recentChats')->name('chats.recent');

            Route::post('deletechat/{id}', 'deletechat')->name('deletechat');

            Route::post('delete', 'deleteMembers')->name('delete');

        });

        Route::controller('UserMemberController')->name('members.')->prefix('members')->group(function () {

            Route::get('/', 'getRelated')->name('all');

        });

    });

    Route::controller('ProfileController')->name('profile.')->prefix('profile')->group(function () {

        Route::post('image/update', 'updateProfileImage')->name('image.update');

        Route::post('data/update', 'updateProfileData')->name('data.update');

        Route::post('password/update', 'updatePassword')->name('password.update');

        Route::post('logout', 'logout')->name('logout');

    });

    Route::controller('UserController')->name('users.')->prefix('users')->group(function () {

        Route::get('without-authenticated', 'getUsersWithoutAuthenticated')->name('without-authenticated.get');

    });

    Route::controller('PlanController')->name('plans.')->prefix('plans')->group(function () {

        Route::get('all', 'all')->name('all');

    });

    Route::controller('LibraryController')->name('library.')->prefix('library')->group(function () {

        Route::name('sections.')->prefix('sections')->group(function () {

            Route::get('all', 'getSections')->name('all');

            Route::get('files/get', 'getLibrariesBySection')->name('files.get');

        });

    });

    Route::controller('TransactionController')->name('transactions.')->prefix('transactions')->group(function () {

        Route::post('store', 'store')->name('store');

    });

    Route::controller('NotificationController')->name('notification.')->prefix('notification')->group(function () {

        Route::post('user-notification',  'usernotification')->name('usernotification');

        Route::post('chanel-notification/{channel}','chanelnotification')->name('chanelnotification');

        Route::get('notifications',       'index')->name('index');

        Route::get('notificationCounter',  'notificationCounter')->name('notificationCounter');

        Route::post('reset-user-notification/{id}',  'resetusernotification')->name('resetusernotification');

        Route::post('resetnotification',  'resetnotification')->name('resetnotification');

        Route::post('reset-chanel-notification/{id}',  'resetchanelnotification')->name('resetchanelnotification');

        Route::post('delete-notification/{id}',  'deletenotification')->name('deletenotification');


    });
});
