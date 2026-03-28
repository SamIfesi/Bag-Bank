<?php
require_once __DIR__ . "/functions/utilities.php";
require_once __DIR__ . "/../app/model/model.php";

class Auth
{
  public static function user()
  {
    if (is_logged_in() === true) {
      // $_SESSION['user'] should be an ID, but if it's an object, extract the id property
      $userId = $_SESSION['user'];
      if (is_object($userId)) {
        $userId = $userId->id ?? null;
      }
      return Model::find('users', 'id', $userId);
    }
    return null;
  }
}
