<?php

require_once '../../backend/db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $data['id'];
    
    // 1. SQL query to fetch user details
    $userQuery = "SELECT * FROM page WHERE id = '$id'";
    $userResult = mysqli_query($conn, $userQuery);

    if (!$userResult) {
        echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
        exit;
    }

    if (mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult); // Fetch user data

        // Prepare response for user details
        $response = array(
            'name' => $userData['name'],
            'username' => $userData['username'],
            'profile_picture_url' => $userData['profile_picture_url'],
            'media_count' => $userData['media_count'],
            'followers_count' => $userData['followers_count'],
            'biography' => $userData['biography']
        );

        // 2. SQL query to fetch media
        $mediaQuery = "SELECT * FROM media WHERE page_id = '$id'";
        $mediaResult = mysqli_query($conn, $mediaQuery);

        if (!$mediaResult) {
            echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
            exit;
        }

        $media = array();
        // Fetch media data
        while ($mediaData = mysqli_fetch_assoc($mediaResult)) {
            $media[] = array(
                'media_type' => $mediaData['media_type'],
                'permalink' => $mediaData['permalink'],
                'media_url' => $mediaData['media_url'],
                'like_count' => $mediaData['like_count'],
                'comments_count' => $mediaData['comments_count'],
                'id' => $mediaData['id']
            );
        }

        $response['media'] = $media;

        // 3. SQL query to fetch demographics
        $demoQuery = "SELECT * FROM demographics WHERE page_id = '$id'";
        $demoResult = mysqli_query($conn, $demoQuery);

        if (!$demoResult) {
            echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
            exit;
        }
        
        $demoData = mysqli_fetch_assoc($demoResult);
        $demographicsAge = json_decode($demoData['age'], true);
        $demographicsCity = json_decode($demoData['city'], true);
        $demographicsGender = json_decode($demoData['gender'], true);
        
        $response['demographicsAge'] = $demographicsAge;
        $response['demographicsCity']=$demographicsCity;
        $response['demographicsGender']=$demographicsGender;

        echo json_encode($response); // Return response
    } else {
        echo json_encode(array('message' => 'No data found.'));
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
