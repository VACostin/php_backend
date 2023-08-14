<?php

function generateCookie()
{
    $expirationTime = time() + 3600; // Expiration time in 1 hour
    $cookieData = array('expiration' => $expirationTime);
    $cookieValue = json_encode($cookieData);
    setcookie(session_id(), $cookieValue, $expirationTime, '/', true, true); // true, true -> Http only, HTTPS only
}

function checkCookieStatus()
{
    if (isset($_COOKIE[session_id()])) {
        error_log("Cookie value: " . $_COOKIE[session_id()]); // Debugging output
        error_log(session_id());
        $cookieData = json_decode($_COOKIE[session_id()], true);
        if (isset($cookieData['expiration'])) {
            $expirationTimestamp = $cookieData['expiration'];

            if (time() > $expirationTimestamp) {
                generateCookie();
            }
        } else {
            error_log("Expiration key not found in cookie data"); // Debugging output
            generateCookie();
        }
    } else {
        error_log("Cookie not found"); // Debugging output
        generateCookie();
    }
}

$sessionMiddleware = function ($request, $response, $next) {
    $newSessionLifetime = 604800; // 1 week
    ini_set('session.gc_maxlifetime', $newSessionLifetime);
    session_start();
    checkCookieStatus();
    $next($request, $response);
};