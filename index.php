<?php

require_once 'middlewares/app.php';
require_once 'middlewares/session_middleware.php';
require_once 'middlewares/security_headers_middleware.php';
require_once 'controllers/static_assets_controller.php';
require_once 'controllers/user_controller.php';

$app = new App($staticAssetsController);
$app->use($sessionMiddleware);
$app->use($securityHeadersMiddleware);

$userController = new UserController();
$app->get('/user/login', [$userController, 'login']);
$app->get('/user/login/github', [$userController, 'loginGithub']);
$app->get('/user/login/github/callback', [$userController, 'loginGithubCallback']);
$app->get('/user/login/gitlab', [$userController, 'loginGitlab']);
$app->get('/user/login/gitlab/callback', [$userController, 'loginGitlabCallback']);
$app->get('/user/logout', [$userController, 'logout']);
$app->get('/user/update', [$userController, 'update']);

$app->run();