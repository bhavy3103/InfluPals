<?php

require_once '../../backend/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM page";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        echo json_encode(array('error' => mysqli_error($conn)));
    } else {
        if (mysqli_num_rows($result) > 0) {
            $usersData = array();
            while ($userData = mysqli_fetch_assoc($result)) {
                $id = $userData['id'];
                
                // Fetch pricing information for each user
                $pricingQuery = "SELECT * FROM pricing WHERE page_id = '$id'";
                $pricingResult = mysqli_query($conn, $pricingQuery);
                $pricingData = mysqli_fetch_assoc($pricingResult);
                
                // Combine user data with pricing data
                $userData['pricing'] = $pricingData;
                $usersData[] = $userData;
            }
            
            header('Content-Type: application/json');
            echo json_encode($usersData);
        } else {
            echo json_encode(array('message' => 'No data found.'));
        }
    }
} else {
    http_response_code(405);
    echo "405 Method Not Allowed";
}

?>
