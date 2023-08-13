<?php

require_once 'middlewares/app.php';
require_once 'middlewares/session_middleware.php';
require_once 'middlewares/security_headers_middleware.php';
require_once 'controllers/home_controller.php';
require_once 'controllers/about_controller.php';

// Create an instance of ExpressApp
$app = new App();
$app->use($sessionMiddleware);
$app->use($securityHeadersMiddleware);
$app->get('/', $homeController);
$app->get('/about', $aboutController);

// Run the app
$app->run();