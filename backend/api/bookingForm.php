<?php
require_once '../db_connection.php';

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $creator_id = $data['id'];
    $creator_username = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM page WHERE id = '$creator_id'"))['username'];
    $uname = $data['uname'];
    $email = $data['email'];
    $contact = $data['contact'];
    $requirements = $data['requirements'];
    $budget = $data['budget'];
    $pageId = $data['$pageId'];
    mysqli_query($conn, "SET foreign_key_checks = 0");
    mysqli_begin_transaction($conn);

    try {
        $insertQuery = "INSERT INTO booking_details( uname ,email , contact , requirements , budget , page_id, user_id) VALUES('$uname','$email','$contact','$requirements','$budget',$creator_id, '$creator_username')";


        mysqli_query($conn, $insertQuery);
        mysqli_commit($conn);
        echo json_encode(array('status' => 'success', 'message ' => ' Data entered successfully!!'));
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(array('status' => 'false', 'message' => $e->getMessage()));
    }

    mysqli_query($conn, "SET foreign_key_checks=1");
} else {
    http_response_code(405);
    echo 'method not allowed';
}
?>