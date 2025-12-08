<?php
session_start();
require_once "functions/utilities.php";
require_once "app/model/model.php";
class Auth
{
    public static function user()
    {
        if (is_logged_in() === true) {
            return Model::find('users', 'id', $_SESSION['user']);
        }
    }
}
