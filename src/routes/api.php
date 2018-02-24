<?php

namespace Silvanite\AgencmsSettings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('agencms')
    ->namespace('Silvanite\AgencmsSettings\Controllers')
    ->middleware(['api', 'cors'])
    ->group(function () {
        Route::resource('settings/{section?}', 'SettingsController');
    });
