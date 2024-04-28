<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 h-screen flex justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>
        <form action="./../../backend/api/loginUser.php" method="POST" onsubmit="return validateForm()" class="center"> <!-- Assuming login.php is the PHP login script -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input required type="email" id="email" name="email" class="mt-1 py-1 px-3 block w-full focus-ring-none rounded-md border-gray-300 bg-gray-50 border">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input required type="password" id="password" name="password" class="mt-1 py-1 px-3 block w-full focus-ring-none rounded-md border-gray-300 bg-gray-50 border">
            </div>
            <div class="flex justify-center items-center mb-4">
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Login</button>
            </div>
            <div class="text-center">
                <span class="text-md font-semibold text-gray-700 mr-1">Don't have an account?</span><a href="./register-user.php" class="text-indigo-500 hover:underline">Register Now</a>
            </div>
        </form>
    </div>
    
    <script>
        <?php
        
        if (isset($_GET['error_message'])) {
            echo "alert('" . htmlspecialchars($_GET['error_message']) . "');";
        }
        ?>
    </script>
</body>

</html>
