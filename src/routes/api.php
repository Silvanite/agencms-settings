<?php

namespace Agencms\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('agencms/settings')
    ->namespace('Agencms\Settings\Controllers')
    ->middleware(['api', 'cors'])
    ->group(function () {
        Route::get('{section?}', 'SettingsController@index');
        Route::post('{section?}', 'SettingsController@store');
    });
