<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM creator";
    $result = mysqli_query($conn, $query); // Pass the connection as the first parameter
    if(!$result){
      echo "Error: " . mysqli_error($conn); // Display the error message
    }
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($data);
    } else {
        echo json_encode(array('message' => 'No data found.'));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "405 Method Not Allowed";
}

?>