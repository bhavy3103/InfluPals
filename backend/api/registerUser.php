<?php

require_once '../../backend/db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $data['id'];
  $name = $data['name'];
  $username = $data['username'];
  $profile_photo=$data['profile_picture_url'];
  $posts = $data['media_count'];
  $email = '';
  $followers = $data['followers_count'];
  $category = '';
  $bio = $data['biography'];
  $impressions = 0;
  $profile_view = 0;
  $media= $data['media'];
  $demographicsId=1;
  $recentpostsId;
  
  mysqli_query($conn, "SET foreign_key_checks = 0");
  
  mysqli_begin_transaction($conn);

    try {
        // Check if user already exists
        $userCheckQuery = "SELECT * FROM creator WHERE id = '$id'";
        $userCheckResult = mysqli_query($conn, $userCheckQuery);
        if (mysqli_num_rows($userCheckResult) > 0) {
            // User already exists, return early
            echo json_encode(array('message' => "User Already Exists"));
            mysqli_commit($conn);
            exit; // Stop further execution
        }

        // Insert media objects into post table
        $postIds = [];
        for ($i = 0; $i < 4; $i++) {
          // $mediaItem = ($i<count($media)) ? $media[$i] : {};
          $mediaItem=$media[$i];
          $mediaType = isset($mediaItem['media_type']) ? $mediaItem['media_type'] : '';
          $thumbnail = isset($mediaItem['media_url']) ? $mediaItem['media_url'] : '';
          $url = isset($mediaItem['permalink']) ? $mediaItem['permalink'] : '';
          $like_count = isset($mediaItem['like_count']) ? $mediaItem['like_count'] : 0;
          $comments_count = isset($mediaItem['comments_count']) ? $mediaItem['comments_count'] : 0;
          $mediaId = isset($mediaItem['id']) ? $mediaItem['id'] : $i;

          $mediaQuery = "INSERT INTO post (id, media_type, thumbnail, url, like_count, comments_count) VALUES ('$mediaId', '$mediaType', '$thumbnail', '$url', '$like_count', '$comments_count')";
          if (mysqli_query($conn, $mediaQuery)) {
            // $postId = mysqli_insert_id($conn);
            $postIds[] = $mediaId;
          } else {
            throw new Exception("Error inserting media: " . mysqli_error($conn));
          }
        }
        // echo json_encode($postIds);
        // exit;
        
        $recentpostQuery="INSERT INTO recentposts (post1, post2, post3, post4) VALUES ('$postIds[0]', '$postIds[1]', '$postIds[2]', '$postIds[3]')";
        mysqli_query($conn, $recentpostQuery);
        $recentpostsId = mysqli_insert_id($conn);

        $sql = "INSERT INTO creator (id, name, username,profile_photo, posts, email, followers, category, bio, impressions, profile_view, demographic_id, recentposts_id) 
          VALUES ('$id', '$name', '$username','$profile_photo', '$posts', '$email', '$followers', '$category', '$bio', '$impressions', '$profile_view', '$demographicsId', '$recentpostsId')";
  
        if (mysqli_query($conn, $sql)) {
            mysqli_commit($conn);
            echo json_encode(array('status' => 'success', 'message' => "Data inserted successfully"));
        } else {
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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