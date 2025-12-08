<?php
require_once "app/model/model.php";
// public function user_exist($username){

// };

class userController
{
    public function show_all()
    {
        $all_users = Model::all('users');
        return $all_users;
    }

    // checks if user exists
    public function user_exist($username)
    {
        $user = Model::find('users', 'username', $username);
        return $user ? true : false;
    }

    // get user: it gets the details of a single user
    public static function get_user($username){
        $user = Model::find('users', 'username', $username);
        return $user;
    }

    public function create_user($data)
    {
        $result = Model::create('users', $data);
        return $result;
    }
}
