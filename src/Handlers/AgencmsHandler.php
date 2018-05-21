<?php

namespace Agencms\Settings\Handlers;

use Agencms\Core\Field;
use Agencms\Core\Group;
use Agencms\Core\Route;
use Agencms\Core\Option;
use Agencms\Core\Relationship;
use Agencms\Settings\Settings;
use Agencms\Core\Facades\Agencms;
use Silvanite\Brandenburg\Policy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
                        Field::text('application-name', 'Application Name')
                    )
                )
        );
    }
}
