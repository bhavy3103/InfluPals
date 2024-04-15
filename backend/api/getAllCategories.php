<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // SQL query to fetch categories
    $categoriesQuery = "SELECT * FROM category";
    $categoriesResult = mysqli_query($conn, $categoriesQuery);

    if (!$categoriesResult) {
        echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
        exit;
    }

    $categories = mysqli_fetch_all($categoriesResult);
    echo json_encode($categories); // Return response
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>