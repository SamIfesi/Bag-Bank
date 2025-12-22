<?php

function old_value($word)
{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST[$word])){
            return htmlspecialchars($_POST[$word]);
        }
    }else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET[$word])){
            return htmlspecialchars($_GET[$word]);
        }
    }else if(isset($_SESSION['old_input'][$word])){
        return htmlspecialchars($_SESSION['old_input'][$word]);
    }
}

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

// generate 16-digit card number
function generate_card_number(){
    // BIN (Bank Identification Number) - first 6 digits
    $bin = '522410';
    
    // Generate middle 9 digits randomly
    $middle_digits = '';
    for($i = 0; $i < 9; $i++){
        $middle_digits .= rand(0, 9);
    }
    
    // Combine BIN + middle digits (15 digits total)
    $partial_card = $bin . $middle_digits;
    
    // Calculate Luhn check digit (last digit)
    $check_digit = calculate_luhn_checksum($partial_card);
    
    return $partial_card . $check_digit;
}

// Luhn algorithm for card validation
function calculate_luhn_checksum($number){
    $sum = 0;
    $num_digits = strlen($number);
    $parity = $num_digits % 2;
    
    for($i = 0; $i < $num_digits; $i++){
        $digit = intval($number[$i]);
        
        if($i % 2 == $parity){
            $digit *= 2;
        }
        
        if($digit > 9){
            $digit -= 9;
        }
        
        $sum += $digit;
    }
    
    return (10 - ($sum % 10)) % 10;
}

// generate CVV (3 digits)
function generate_cvv(){
    return str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
}

// generate card expiry (format: MM/YYYY)
function generate_card_expiry(){
    $current_year = date('Y');
    $expiry_year = $current_year + 5; // Card valid for 5 years
    $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
    return $month . '/' . $expiry_year;
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