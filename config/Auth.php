<?php
require_once __DIR__ . "/functions/utilities.php";
require_once __DIR__ . "/../app/model/model.php";

class Auth
{
    public static function user()
    {
        if (is_logged_in() === true) {
            return Model::find('users', 'id', $_SESSION['user']);
        }
        return null;
    }
}
