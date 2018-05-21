<?php

namespace Agencms\Settings\Providers;

use Illuminate\Routing\Router;
use Agencms\Core\Facades\Agencms;
use Silvanite\Brandenburg\Policy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Http\Kernel;
use Silvanite\Brandenburg\Permission;
use Illuminate\Support\ServiceProvider;
use Agencms\Settings\Middleware\AgencmsConfig;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;

class SettingsServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router, Kernel $kernel)
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->registerApiRoutes();

        $this->registerAgencms($router);
    }

    /**
     * Register router middleware as plugin for Agencms. This will include all
     * user related admin screen and endpoints in the CMS.
     *
     * @param Router $router
     * @return void
     */
    private function registerAgencms(Router $router)
    {
        $router->aliasMiddleware('agencms.settings', AgencmsConfig::class);
        Agencms::registerPlugin('agencms.settings');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPermissions();
    }

    /**
     * Load Api Routes into the application
     *
     * @return void
     */
    private function registerApiRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }

    /**
     * Register default package related permissions
     *
     * @return void
     */
    private function registerPermissions()
    {
        collect([
            'settings_read',
            'settings_update',
        ])->map(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($this->nobodyHasAccess($permission)) {
                    return true;
                }

                return $user->hasRoleWithPermission($permission);
            });
        });
    }
}
