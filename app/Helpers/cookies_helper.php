<?php

// app/Helpers/cookie_helper.php

if (!function_exists('set_app_cookie')) {
    function set_app_cookie($name, $value, $expire = 3600, $path = '/', $domain = '', $secure = false, $httpOnly = true, $sameSite = 'Lax')
    {
        $cookie = [
            'name'     => $name,
            'value'    => $value,
            'expire'   => $expire,
            'path'     => $path,
            'domain'   => $domain,
            'secure'   => $secure,
            'httpOnly' => $httpOnly,
            'sameSite' => $sameSite,
        ];

        $response = service('response');
        $response->setCookie($cookie);
    }
}

if (!function_exists('get_app_cookie')) {
    function get_app_cookie($name)
    {
        $request = service('request');
        return $request->getCookie($name);
    }
}

if (!function_exists('delete_app_cookie')) {
    function delete_app_cookie($name, $path = '/', $domain = '')
    {
        $response = service('response');
        $response->deleteCookie($name);
    }
}
