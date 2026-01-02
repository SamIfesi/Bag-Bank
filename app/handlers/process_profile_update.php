<?php
session_start();
require_once __DIR__ . "/../../config/functions/utilities.php";
require_once __DIR__ . "/../../app/controller/userController.php";

$userController = new userController();
$errors = [];
$updateData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user'];
    $user = Model:: find('users', 'id', $user_id);

    if (!$user) {
        $_SESSION['error_msg'] = 'User not found';
        header("Location: ../views/my_profile.php");
        exit();
    }


    // Validate and sanitize inputs
    $date_of_birth = isset($_POST['date_of_birth']) ? sanitize_input($_POST['date_of_birth']) : '';
    $gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
    $phone_number = isset($_POST['phone_number']) ? sanitize_input($_POST['phone_number']) : '';
    $address = isset($_POST['address']) ? sanitize_input($_POST['address']) : '';
    $city = isset($_POST['city']) ? sanitize_input($_POST['city']) : '';
    $state = isset($_POST['state']) ? sanitize_input($_POST['state']) : '';
    $occupation = isset($_POST['occupation']) ? sanitize_input($_POST['occupation']) : '';
    $bio = isset($_POST['bio']) ? sanitize_input($_POST['bio']) : '';

    // Validate Date of Birth
    if (!empty($date_of_birth)) {
        $dob_timestamp = strtotime($date_of_birth);
        $age = (int)((time() - $dob_timestamp) / (365.25 * 24 * 60 * 60));
        
        if ($age < 18) {
            $errors[] = "You must be at least 18 years old";
        } else {
            $updateData['date_of_birth'] = $date_of_birth;
        }
    }

    // Validate Gender
    if (!empty($gender) && in_array($gender, ['male', 'female'])) {
        $updateData['gender'] = $gender;
    }else if (empty($gender)) {
        $errors[] = "Please select a gender";
    }

    // Validate Phone Number
    if (!empty($phone_number)) {
        // Remove spaces and special characters
        $cleaned_phone = preg_replace('/[^0-9+]/', '', $phone_number);
        
        if (strlen($cleaned_phone) < 10 || strlen($cleaned_phone) > 15) {
            $errors[] = "Invalid phone number format";
        } else {
            $updateData['phone_number'] = $phone_number;
        }
    }

    // Add other fields (no special validation needed)
    if (!empty($address)) $updateData['address'] = $address;
    if (!empty($city)) $updateData['city'] = $city;
    if (!empty($state)) $updateData['state'] = $state;
    if (!empty($occupation)) $updateData['occupation'] = $occupation;
    if (!empty($bio)) {
        if (strlen($bio) > 500) {
            $errors[] = "Bio must not exceed 500 characters";
        } else {
            $updateData['bio'] = $bio;
        }
    }

    // Handle Profile Image Upload
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
        $max_size = 5 * 1024 * 1024; // 5MB

        $file_type = $_FILES['user_image']['type'];
        $file_size = $_FILES['user_image']['size'];
        $file_tmp = $_FILES['user_image']['tmp_name'];
        $file_name = $_FILES['user_image']['name'];

        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Only JPG, JPEG, PNG, SVG & GIF files are allowed";
        }

        // Validate file size
        if ($file_size > $max_size) {
            $errors[] = "Image size must not exceed 5MB";
        }

        if (empty($errors)) {
            // Create uploads directory if it doesn't exist
            $upload_dir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_filename = 'avatar_' . $user_id . '_' . time() . '.' . $file_extension;
            $upload_path = $upload_dir .  $new_filename;

            // Move uploaded file
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Delete old image if exists
                if (! empty($user->user_image) && file_exists(__DIR__ . '/../../' . $user->user_image)) {
                    unlink(__DIR__ . '/../../' . $user->user_image);
                }

                $updateData['user_image'] = 'public/uploads/' . $new_filename;
            } else {
                $errors[] = "Failed to upload image";
            }
        }
    }

    // Check for errors
    if (!empty($errors)) {
        $_SESSION['error_msg'] = implode(', ', $errors);
        header("Location:../../views/my_profile.php");
        exit();
    }

    // Update user profile
    if (! empty($updateData)) {
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        
        $updated = Model::update('users', $updateData, $user_id);

        if ($updated) {
            $_SESSION['success_msg'] = 'Profile updated successfully!';
        } else {
            $_SESSION['error_msg'] = 'Failed to update profile.  Please try again.';
        }
    } else {
        $_SESSION['error_msg'] = 'No changes to save';
    }

    header("Location:../../views/my_profile.php");
    exit();
} else {
    header("Location:../../views/my_profile.php");
    exit();
}