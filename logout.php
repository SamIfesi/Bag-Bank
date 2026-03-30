<?php
require_once __DIR__ . "/core/Session.php"; 
Session::stop();
header("Location: views/login.php");
exit();
