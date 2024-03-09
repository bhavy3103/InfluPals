<?php
include('server.php');
function setpost($data)
{

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    
    global $db;
    echo ($data);
    // $data = json_decode(file_get_contents("php://input"), true);

    // if (isset($data['id']) && isset($data['media_type']) && isset($data['thumbnail']) && isset($data['url'])) {
    //     $id = $data['id'];
    //     $media_type = $data['media_type'];
    //     $thumbnail = $data['thumbnail'];
    //     $url = $data['url'];

    //     $query = "INSERT INTO `post` (`id`, `media_type`, `thumbnail`, `url`) VALUES ('$id', '$media_type', '$thumbnail', '$url')";

    //     $run = mysqli_query($db, $query);

    //     if ($run) {
    //         echo json_encode(['status' => 'success', 'msg' => 'Data inserted successfully']);
    //     } else {
    //         echo json_encode(['status' => 'failed', 'msg' => 'Data not inserted']);
    //     }
    // } else {
    //     http_response_code(400);
    //     echo json_encode(['status' => 'failed', 'msg' => 'id, media_type, thumbnail, url are required']);
    // }
}


?>