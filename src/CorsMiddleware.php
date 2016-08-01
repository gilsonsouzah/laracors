<?php

namespace LaraCors\Cors;

use Closure;
use Config;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allow = $this->getPermission();

        return $next($request)->header('Access-Control-Allow-Origin', $allow)
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE, PATCH, HEAD')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Origin, X-CSRF-Token');
    }

    /**
     * Get cors permissions on config file
     * @return mixed
     */
    private function getPermission()
    {
        $allow = '';
        $permissions = Config::get('cors.permissions', ['']);

        if ($permissions == '*' || $permissions == ['*']) {
            return '*';
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            $url = parse_url($_SERVER['HTTP_REFERER']);

            if (in_array($url['host'], $permissions)) {
                return $url['scheme'].'://'.$url['host'];
            }

            if (in_array($url['host'].':'.$url['port'], $permissions)) {
                return $url['scheme'].'://'.$url['host'].':'.$url['port'];
            }
        }

        return '';
    }
}
