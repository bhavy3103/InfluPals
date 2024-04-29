<?php
require_once '../../backend/db_connection.php';
session_start();

function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageId=$_SESSION['id'];
    
    $storyPrice = $data['story'];
    $igtvVideoPrice = $data['igtv_video'];
    $reelPrice = $data['reel'];
    $liveStreamPrice = $data['live_stream'];
    $feedPostPrice = $data['feed_post'];

    $updateQuery = "UPDATE pricing SET story = '$storyPrice', igtv_video = '$igtvVideoPrice', reel = '$reelPrice', live_stream = '$liveStreamPrice', feed_post = '$feedPostPrice' WHERE page_id = '$pageId'";

    if (mysqli_query($conn, $updateQuery)) {
        echo json_encode(array('status' => 'success', 'message' => 'Pricing details updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to update pricing details: ' . mysqli_error($conn)));
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Method Not Allowed'));
}
?>