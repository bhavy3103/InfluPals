<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // SQL query to fetch categories
    $bookingsQuery = "SELECT * FROM booking_details";
    $bookingsResult = mysqli_query($conn, $bookingsQuery);

    if (!$bookingsResult) {
        echo json_encode(array('error' => mysqli_error($conn))); // Return error message if query fails
        exit;
    }

    $bookings = mysqli_fetch_all($bookingsResult, MYSQLI_ASSOC);
    echo json_encode($bookings); // Return response
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}
?>