<?php

require_once '../../backend/db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $data['id'];
    $name = $data['name'];
    $username = $data['username'];
    $profile_picture_url = $data['profile_picture_url'];
    $media_count = $data['media_count'];
    $followers_count = $data['followers_count'];
    $category = $data['category'];
    $biography = $data['biography'];
    $location = $data['location'];

    mysqli_query($conn, "SET foreign_key_checks = 0");

    mysqli_begin_transaction($conn);

    try {
        // Check if user already exists
        $userCheckQuery = "SELECT * FROM page WHERE id = '$id'";
        $userCheckResult = mysqli_query($conn, $userCheckQuery);
        if (mysqli_num_rows($userCheckResult) > 0) {
            // User already exists, return early
            echo json_encode(array('message' => "User Already Exists", "id" => $id));
            mysqli_commit($conn);
            exit; // Stop further execution
        }

        // Insert user data into profile table
        $insertQuery = "INSERT INTO page (id, type, name, username, profile_picture_url, media_count, followers_count, category, biography, location) 
                          VALUES ('$id', '', '$name', '$username', '$profile_picture_url', '$media_count', '$followers_count', '$category', '$biography', '$location')";

        if (mysqli_query($conn, $insertQuery)) {
            mysqli_commit($conn);
            echo json_encode(array('status' => 'success', 'message' => "Data inserted successfully"));
        } else {
            echo json_encode(array('status' => 'error', 'message' => mysqli_error($conn)));
        }
        
    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($conn);
        echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
    }

    mysqli_query($conn, "SET foreign_key_checks = 1");

} else {
    http_response_code(405); // Method Not Allowed
    echo "405 Method Not Allowed";
}

?>
