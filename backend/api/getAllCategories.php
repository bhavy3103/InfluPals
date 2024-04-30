<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response = array();

    // SQL query to fetch categories
    $categoriesQuery = "SELECT * FROM category";
    $categoriesResult = mysqli_query($conn, $categoriesQuery);

    // SQL query to fetch category frequencies
    $categoryFreqQuery = "SELECT category, COUNT(*) as count FROM page GROUP BY category";
    $categoryFreqResult = mysqli_query($conn, $categoryFreqQuery);

    if (!$categoriesResult || !$categoryFreqResult) {
        echo json_encode(array('errorrrr' => mysqli_error($conn))); // Return error message if query fails
        exit;
    }

    // Fetch categories
    $categories = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);

    // Fetch category frequencies
    $categoryFreq = array();
    while ($row = mysqli_fetch_assoc($categoryFreqResult)) {
        $categoryFreq[$row['category']] = $row['count'];
    }
    $response['categoryFreq'] = $categoryFreq;

    $response['categories'] = $categories;
    echo json_encode($response); // Return response
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>
