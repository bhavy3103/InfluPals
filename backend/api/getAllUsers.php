<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM page";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        echo json_encode(array('error' => mysqli_error($conn)));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(array('message' => 'No data found.'));
        }
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}

?>
