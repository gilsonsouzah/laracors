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
        $allowOrigin = $this->getPermission();
        $allowedMethods = $this->getAllowedMethods();
        $allowCredentials = $this->getCredentials();
        $allowedHeaders = $this->getAllowedHeaders();

        return $next($request)->header('Access-Control-Allow-Origin', $allowOrigin)
            ->header('Access-Control-Allow-Methods', $allowedMethods)
            ->header('Access-Control-Allow-Credentials', $allowCredentials)
            ->header('Access-Control-Allow-Headers', $allowedHeaders);
    }

    /**
     * Get cors permissions on config file
     * @return mixed
     */
    private function getPermission()
    {
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

    /**
     * Get cors methods allowed on config file
     * @return string String of allowed methods separated by comma.
     */
    private function getAllowedMethods()
    {
        $methods = Config::get('cors.allowedMethods', 'POST, GET, OPTIONS, PUT, DELETE');

        return $methods;
    }

    /**
     * Get cors headers allowed on config file
     * @return string String of allowed headers separated by comma.
     */
    private function getAllowedHeaders()
    {
        $headers = Config::get('cors.allowedHeaders', 'Content-Type, Accept, Authorization, X-Requested-With, Origin, X-CSRF-Token');

        return $headers;
    }

    /**
     * Get cors authentication allowed on config file
     * @return string State of authentication on cors
     */
    private function getCredentials()
    {
        $headers = Config::get('cors.allowCredentials', false);

        return ($headers) ? 'true' : 'false';
    }
}
