<?php

namespace Silvanite\AgencmsSettings\Handlers;

use Agencms\Core\Route;
use Agencms\Core\Field;
use Agencms\Core\Group;
use Agencms\Core\Option;
use Silvanite\Brandenburg\Policy;
use Agencms\Core\Relationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Agencms\Core\Facades\Agencms;
use Silvanite\AgencmsSettings\Settings;

class AgencmsHandler
{
    /**
     * Register all routes and models for the Admin GUI (AUI)
     *
     * @return void
     */
    public static function registerAdmin()
    {
        if (!Gate::allows('settings_read')) {
            return;
        }

        self::registerSettings();
    }

    /**
     * Register the Agencms endpoints for Settings administration
     *
     * @return void
     */
    private static function registerSettings()
    {
        Agencms::registerRoute(
            Route::initSingle('settings', ['Settings' => 'Global Settings'], '/agencms/settings/global')
                ->addGroup(
                    Group::full('Global Settings')->addField(
                        Field::boolean('maintenance', 'Maintenance mode')
                    )
                )
        );
    }
}
