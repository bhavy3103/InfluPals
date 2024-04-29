<nav class="bg-white sticky top-0 border-b border-gray-300 p-4 flex items-center justify-between shadow-lg ">

    <div class="flex w-full justify-between items-center">
        <div class="flex justify-between">
            <div class="flex justify-between gap-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-2">
                <span class="text-2xl font-extrabold text-blue-800 uppercase">Influanza</span>
            </div>
            <div class="space-x-3 pe-200">
                <a href="../index.php"
                    class="text-blue-900 hover:bg-orange-400 hover:text-blue-800 rounded-md px-3 py-2 text-lg font-medium">Home</a>
                <?php
                if ($isAdmin) {
                    echo '<a href="./admin-dashboard.php"
                class="text-blue-900 hover:bg-orange-400 hover:text-blue-800 rounded-md px-3 py-2 text-lg font-medium">Admin</a>';
                }
                ?>
            </div>
        </div>

        <div class="flex items-center">
            <?php
            if ($flag) {
                echo '<input type="text" class="border border-gray-300 rounded-md p-2 pl-8" placeholder="Search...">
                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    </div>';
            }
            ?>

            <div class="relative">
                <?php
                if ($isflag) {
                    echo '<input type="text" id="searchInput" class="border border-gray-300 rounded-md p-2 pl-8 w-80 mr-2"
                        placeholder="Search by name or city" onkeyup="searchUsers(event)">  
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>';
                }
                if ($isCompare) {
                    echo '<button onclick="compareSelectedUsers()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Compare</button>
';
                }
                ?>
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2"
                onclick="logoutUser()">Logout</button>
        </div>
    </div>
</nav>