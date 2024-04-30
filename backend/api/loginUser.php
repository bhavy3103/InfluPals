<?php

try {
    require_once '../../backend/db_connection.php';
    session_start();
    function sanitizeInput($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!validateEmail($email)) {
            header("Location: __dir__/../../../frontend/auth/login-user.php?error_message=Invalid email format");
            exit;
        }

        $check_query = "SELECT * FROM user WHERE email = '$email'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) == 0) {
            header("Location: __dir__/../../../frontend/auth/login-user.php?error_message=Email not found");
            exit;
        }

        $user_data = mysqli_fetch_assoc($check_result);
        $stored_password = $user_data['password'];
        $id = $user_data['id'];
        $role = $user_data['role'];

        if (!password_verify($password, $stored_password)) {
            header("Location: __dir__/../../../frontend/auth/login-user.php?error_message=Incorrect password");
            exit;
        }

        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;

        if ((strtolower($_SESSION['role'])) == "admin") {
            header("Location: __dir__/../../../frontend/page/admin-dashboard.php?$id"); 
            // Redirect to home page after successful login
            exit;
        } else {
            header("Location: __dir__/../../../frontend/page/home.php");
            exit;
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(array('status' => 'error', 'message' => 'Method Not Allowed'));
    }
} catch (Throwable $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}
?>