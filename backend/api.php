<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // getAllData();
        echo "Hello World"; // Echo a string directly
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        // setPost($data);
        // Echo specific elements of the array or convert the array to a string
        echo json_encode($data); // Convert the array to a JSON string
        break;
}
?>
