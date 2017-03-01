<?php

/**
 *LARACORS - Laravel 5.0 Cors Package.
 *
 * @author Gilson F. B. Souza <gilsonfernandesbatista@gmail.com>
 */
return [
    /*
    * Configure the allowed domains to access cors service. Set the domains on
    * permissions, in array format, or use * for allow all domains.
    */
    'permissions' => '*',

    /*
    * Configure the allowed methods, separated by comma.
    */
    'allowedMethods' => 'POST, GET, OPTIONS, PUT, DELETE, PATCH, HEAD',

    /*
    * Configure the allowed headers in request, separated by comma.
    */
    'allowedHeaders' => 'Content-Type, Accept, Authorization, X-Requested-With, Origin, X-CSRF-Token',

    /*
    * Set if request allow use credentials for login. Enable this option to use authentication with
    * guard or another authenticator driver.
    */
    'allowCredentials' => true,
];
