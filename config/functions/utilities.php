<?php
function is_empty($value)
{
    return !isset($value) || (trim($value) === '');
}
function check_empty_fields(array $required_fields, array $user_inputs, array $error)
{
    foreach ($user_inputs as $key => $value) {
        if (in_array($key, $required_fields) && strlen($value) < 1) {
            array_push($error, "please fill in $key");
        }
    }
}

function sanitize_input($data)
{
    return htmlspecialchars(strip_tags($data));
}
function is_safe_password($password)
{
    $pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
    return preg_match($pattern, $password);
}
function is_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function is_match($value1, $value2)
{
    return $value1 === $value2;
}
// generate account number
function generate_account_number(){
    // create first two digits
    $unqiue_code = 103;
    // generate random 7 digits
    $random_number = strval(time());
    $account_number = $unqiue_code . substr($random_number, -7);
    return $account_number;
}
// redirect to a given location
function redirect_to($location)
{
    header("Location: " . $location);
    exit();
}

// authenticate user
function is_logged_in(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        return true;
    } else {
        return false;
    }
}