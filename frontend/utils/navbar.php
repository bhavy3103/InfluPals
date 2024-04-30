<nav class="bg-white sticky top-0 border-b border-gray-300 p-4 flex items-center justify-between shadow-lg ">

    <div class="flex w-full justify-between items-center">
        <div class="flex justify-between gap-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-0">
            <span class="text-2xl font-extrabold text-blue-800 uppercase">Influanza</span>
        </div>
        <div class="space-x-3 ml-6 pe-200">
            <a href="./home.php" class="text-blue-900 hover:text-blue-800 hover:underline rounded-md px-3 py-2 text-xl font-semibold">Home</a>
            <?php
            if ($showAdminDashboardNavigation) {
                echo '<a href="./admin-dashboard.php"
            class="text-blue-900 hover:underline hover:text-blue-800 rounded-md px-3 py-2 text-lg font-semibold">Admin</a>';
            }
            ?>
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
                if ($showSearchBar) {
                    echo '<input type="text" id="searchInput" class="border border-gray-300 rounded-md p-2 pl-8 w-50 mr-2"
                        placeholder="Search by name or city" onkeyup="searchUsers(event)">  
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>';
                }
                if ($showCompareUserButton) {
                    echo '<button onclick="compareSelectedUsers()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Compare</button>
';
                }
                ?>
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2" onclick="logoutUser()">Logout</button>
        </div>
    </div>
</nav>

<script>
    const logoutUser = () => {
        fetch('../../backend/api/logout.php', {
            method: 'POST'
        }).then((res) => {
            window.location.href = '../index.php'
        })
    };
</script>