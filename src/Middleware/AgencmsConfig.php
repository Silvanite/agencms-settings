<?php

namespace Silvanite\AgencmsSettings\Middleware;

use Closure;
use Silvanite\AgencmsSettings\Handlers\AgencmsHandler;

class AgencmsConfig
{
    /**
     * Register Agencms endpoints
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        AgencmsHandler::registerAdmin();
        return $next($request);
    }
}
