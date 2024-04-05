<?php

require_once '../../backend/db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $data['id'];
    // $id=1;
    
    // SQL query to fetch user details
    $query = "SELECT * FROM page WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        $profileData = mysqli_fetch_assoc($result); // Fetch user data

        // Prepare response in the required format
        $response = array(
            'id' => $profileData['id'],
            'type' => $profileData['type'],
            'name' => $profileData['name'],
            'username' => $profileData['username'],
            'profile_picture_url' => $profileData['profile_picture_url'],
            // You need to adjust these based on your table structure
            'media_count' => $profileData['media_count'],
            'followers_count' => $profileData['followers_count'],
            'category' => $profileData['category'],
            'biography' => $profileData['biography'],
            'location' => $profileData['location']
        );

        echo json_encode($response); // Return response
    } else {
        echo json_encode(array('message' => 'No data found.'));
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
