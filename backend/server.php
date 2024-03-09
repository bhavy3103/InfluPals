<?php
// Function to generate an array of random IDs for the four posts
function generateRandomPostIds($prefix) {
  $postIds = array();
  for ($i = 1; $i <= 4; $i++) {
      // Use uniqid() function to generate a unique ID for each post based on the current timestamp
      // The prefix is added to the generated ID to make it more meaningful
      do {
          $postId = $prefix . uniqid("_$i");
      } while (in_array($postId, $postIds)); // Check if the generated ID already exists
      $postIds[] = $postId;
  }
  return $postIds;
}

include('index.php'); 
$db = mysqli_connect('localhost', 'root', '', 'mad');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 1: Generate random IDs
$postIds = generateRandomPostIds('post_');
$recentpostsId = uniqid('recentposts_');
$demographicsId = uniqid('demographics_');

// Step 2: Prepare post data
$post1 = array(
    'id' => 1,
    'media_type' => 'Type 1',
    'thumbnail' => 'Thumbnail 1',
    'url' => 'url 1'
);

$post2 = array(
    'id' => 2,
    'media_type' => 'Type 2',
    'thumbnail' => 'Thumbnail 2',
    'url' => 'url 2'
);

$post3 = array(
    'id' => 3,
    'media_type' => 'Type 3',
    'thumbnail' => 'Thumbnail 3',
    'url' => 'url 3'
);

$post4 = array(
    'id' => 4,
    'media_type' => 'Type 4',
    'thumbnail' => 'Thumbnail 4',
    'url' => 'url 4'
);

// Step 3: Insert post data into the `post` table
foreach ([$post1, $post2, $post3, $post4] as $post) {
    $sql = "INSERT INTO post (id, media_type, thumbnail, url) VALUES ('{$post['id']}', '{$post['media_type']}', '{$post['thumbnail']}', '{$post['url']}')";

    if (!mysqli_query($db, $sql)) {
        echo "Error inserting data into post table: " . mysqli_error($db);
        exit;
    }
}

// Step 4: Insert data into the `recentposts` table
$sql = "INSERT INTO recentposts (id, post1, post2, post3, post4) VALUES ('$recentpostsId', '{$post1['id']}', '{$post2['id']}', '{$post3['id']}', '{$post4['id']}')";

if (!mysqli_query($db, $sql)) {
    echo "Error inserting data into recentposts table: " . mysqli_error($db);
    exit;
}

// Step 5: Prepare static demographics data
$demographicsData = array(
    'follower_city' => 'City Name',
    'follower_age' => 25,
    'follower_gender' => 'Male',
    'engaged_city' => 'Another City',
    'engaged_age' => 30,
    'engaged_gender' => 'Female',
    'reach_city' => 'Yet Another City',
    'reach_age' => 35,
    'reach_gender' => 'Other'
);

// Step 6: Insert data into the `demographics` table
$sql = "INSERT INTO demographics (id, follower_city, follower_age, follower_gender, engaged_city, engaged_age, engaged_gender, reach_city, reach_age, reach_gender) 
        VALUES ('$demographicsId', '{$demographicsData['follower_city']}', {$demographicsData['follower_age']}, '{$demographicsData['follower_gender']}', '{$demographicsData['engaged_city']}', 
        {$demographicsData['engaged_age']}, '{$demographicsData['engaged_gender']}', '{$demographicsData['reach_city']}', {$demographicsData['reach_age']}, '{$demographicsData['reach_gender']}')";

if (!mysqli_query($db, $sql)) {
    echo "Error inserting data into demographics table: " . mysqli_error($db);
    exit;
}

// Step 7: Insert data into the `creator` table



$id = uniqid('creator_');
$name = 'User Name';
$username = 'User123';
$email = 'user@example.com';
$category = 'Category';
$bio = 'User bio goes here';
$impressions = '123'; // Assuming this is not provided
$profile_view = '123'; // Assuming this is not provided

$sql = "INSERT INTO creator (id, name, username, posts, email, followers, category, bio, impressions, profile_view, demographic_id, recentposts_id) 
        VALUES ('$id', '$name', '$username', '', '$email', 0, '$category', '$bio', '$impressions', '$profile_view', '$demographicsId', '$recentpostsId')";

if (mysqli_query($db, $sql)) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

mysqli_close($db);
?>
