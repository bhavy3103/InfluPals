<?php
// global $db;

function getAllData() {
  // global $db;
  // if(!$db){
  //   die("Connection failed: " . mysqli_connect_error());
  // }
  $db= mysqli_connect('localhost', 'root', '', 'mad');
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT * FROM creator";
  $result = mysqli_query($db, $query);
  if(!$result){
    // echo "Error: " . $query . "<br>" . mysqli_error($db);
    echo "Error: ";
  }
  if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
      echo json_encode($data);
  } else {
      echo json_encode(array('message' => 'No data found.'));
  }
  // $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  echo json_encode($result); // Convert the array to a JSON string
  // For demonstration, just echoing a sample message
  echo "Hello World"; // Replace with your actual data retrieval and processing logic
}

// function setPost($data) {
//   // Assuming you have a database connection established
//   // Insert data into the database
//   // Example:
//   // $name = $data['name'];
//   // $email = $data['email'];
//   // $query = "INSERT INTO your_table (name, email) VALUES ('$name', '$email')";
//   // $result = mysqli_query($connection, $query);
  
//   // For demonstration, just echoing the received data
//   echo json_encode($data); // Convert the array to a JSON string
// }


// function setPost($data) {
  $db = mysqli_connect('localhost', 'root', '', 'mad');
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_query($db, "SET foreign_key_checks = 0");

  $id = 123;
  $name = 'User Name';
  $username = 'User123';
  $email = 'user@example.com';
  $category = 'Category';
  $bio = 'User bio goes here';
  $impressions = '123'; // Assuming this is not provided
  $profile_view = '123'; // Assuming this is not provided
  $demographicsId = 123;
  $recentpostsId = 123;
  
  $sql = "INSERT INTO creator (id, name, username, posts, email, followers, category, bio, impressions, profile_view, demographic_id, recentposts_id) 
          VALUES ('$id', '$name', '$username', '', '$email', 0, '$category', '$bio', '$impressions', '$profile_view', '$demographicsId', '$recentpostsId')";
  
  if (mysqli_query($db, $sql)) {
      echo "Data inserted successfully";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }
  mysqli_query($db, "SET foreign_key_checks = 1");

  mysqli_close($db);
// }
?>