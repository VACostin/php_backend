<?php
$homeController = function ($request, $response) {
    $_SESSION['user'] = 'John';
    $response->send("Hello, this is the home page!");
};