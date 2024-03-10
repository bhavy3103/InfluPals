<?php

require_once '../../backend/db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $data['id'];
    $query= "SELECT creator.id, creator.name, creator.username, creator.posts, creator.email, creator.followers, 
      creator.category, creator.bio, creator.impressions, creator.profile_view, creator.demographic_id, creator.recentposts_id, 
      recentposts.post1, recentposts.post2, recentposts.post3, recentposts.post4
      FROM creator
      INNER JOIN recentposts ON creator.recentposts_id = recentposts.id
      WHERE creator.id = '$id'";

    $result = mysqli_query($conn, $query); // Pass the connection as the first parameter
    $userdata=mysqli_fetch_all($result, MYSQLI_ASSOC);

    $p1=$userdata[0]['post1'];
    $p2=$userdata[0]['post2'];
    $p3=$userdata[0]['post3'];
    $p4=$userdata[0]['post4'];

    if (!$result) {
        echo "Error: " . mysqli_error($conn); // Display the error message
    }
    if (mysqli_num_rows($result) > 0) {
        $postsquery = "SELECT * FROM post WHERE id IN ($p1, $p2, $p3, $p4)";
        $posts=mysqli_query($conn, $postsquery);
        $data = mysqli_fetch_all($posts, MYSQLI_ASSOC);
        // echo json_encode($data);
        // exit;

        $response = array();

        $response['creator'] = $userdata[0];
        foreach ($data as $media) {
            $response['media'][] = $media;
        }
        echo json_encode($response);
    } else {
        echo json_encode(array('message' => 'No data found.'));
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}

?>
