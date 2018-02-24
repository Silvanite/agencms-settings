<?php

namespace Silvanite\AgencmsSettings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('agencms/settings')
    ->namespace('Silvanite\AgencmsSettings\Controllers')
    ->middleware(['api', 'cors'])
    ->group(function () {
        Route::get('{section?}', 'SettingsController@index');
        Route::post('{section?}', 'SettingsController@store');
    });
