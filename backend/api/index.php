<?php

// $method = $_SERVER['REQUEST_METHOD'];

// include('temp_api.php');

// switch ($method) {
//     case 'GET':
//         getAllData();
//         break;
//     case 'POST':
//         $data = json_decode(file_get_contents("php://input"), true);
//         setPost($data);
//         break;
// }

// ----------------
$routes = [
    '/api/getAllUsers' => 'getAllUsers.php',
    '/api/getSingleUser' => 'getSingleUser.php',
    '/api/registerUser' => 'registerUser.php',
    // '/api/updateData' => 'updateData.php',
];

$requestUrl = $_SERVER['REQUEST_URI'];

if (isset($routes[$requestUrl])) {
    include $routes[$requestUrl];
} else {
    http_response_code(404);
    echo "404 Not Found";
}


?>
