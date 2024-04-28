<?php
require_once '../../backend/db_connection.php';

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePhoneNumber($phone) {
    return preg_match('/^[0-9]{10}$/', $phone);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';

    if (!validateEmail($email)) {
        header("Location: ../../frontend/page/register-user.php?error_message=Invalid email format");
        exit;
    }

    if (!validatePhoneNumber($phone)) {
        header("Location: ../../frontend/page/register-user.php?error_message=Invalid phone number format");
        exit;
    }

    $check_query = "SELECT * FROM user WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: ../../frontend/page/register-user.php?error_message=Email already exists");
        exit;
    }

    $query = "INSERT INTO user (Name, email, phone, password, role) VALUES ('$name', '$email', '$phone', '$password', 'user')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: ../../frontend/page/login-user.php?error_message=Registration successful. Please login to continue");
        exit;
    } else {
        header("Location: ../../frontend/page/register-user.php?error_message=Registration failed. Please try again");
        exit;
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method Not Allowed'));
}
?>
