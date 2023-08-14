<?php
class UserController
{
    public function login()
    {
        if (isset($_SESSION['token'])) {
            http_response_code(200);
            echo "Authorized";
        } else {
            http_response_code(401);
            echo "Unauthorized";
        }
    }
    public function logout()
    {
        setcookie(session_id(), '', time() - 3600, '/');
        session_destroy();
        echo "Logged out!";
    }

    public function update()
    {
        echo "Updating...";
    }
}