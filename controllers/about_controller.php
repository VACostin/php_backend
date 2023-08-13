<?php
$aboutController = function ($request, $response) {
    $user = $_SESSION['user'];
    $response->send("This is the about page. User: $user");
};