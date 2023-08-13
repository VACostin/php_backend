<?php

$sessionMiddleware = function ($request, $response, $next) {
    // Set the session.gc_maxlifetime to a new value (in seconds)
    $newSessionLifetime = 604800; // 1 week
    ini_set('session.gc_maxlifetime', $newSessionLifetime);

    // Start the session
    session_start();

    // Call the next middleware or controller
    $next($request, $response);
};