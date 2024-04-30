<nav class="bg-white sticky top-0 border-b border-gray-300 p-4 flex items-center justify-between shadow-lg ">

    <div class="flex w-full justify-between items-center">
        <div class="flex justify-between gap-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-0">
            <span class="text-2xl font-extrabold text-blue-800 uppercase">Influanza</span>
        </div>
        <div class="space-x-3 ml-6 pe-200">
            <a href="./home.php"
                class="text-blue-900 hover:text-blue-800 hover:underline rounded-md px-3 py-2 text-xl font-semibold">Home</a>
            <?php
            if ($showAdminDashboardNavigation) {
                echo '<a href="./admin-dashboard.php"
            class="text-blue-900 hover:underline hover:text-blue-800 rounded-md px-3 py-2 text-lg font-semibold">Admin</a>';
            }
            ?>
        </div>

        <div class="flex items-center">
            <?php
            if ($isLoggedIn)
                echo '<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2"
                    onclick="logoutUser()">Logout</button>';
            else
                echo '<div class="relative inline-block text-left">
                <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 text-sm leading-5 font-medium shadow-sm focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150" id="options-menu" aria-haspopup="true" aria-expanded="false">
                  Login As
                </button>
              
                <ul class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                  <li><a href="./auth/login-creator.php" class="block z-2 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Creator</a></li>
                  <li><a href="./auth/login-user.php" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Client</a></li>
                </ul>
              </div>
              ';
            ?>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("options-menu");
        const menu = document.querySelector("[aria-labelledby='options-menu']");

        // Toggle dropdown menu visibility when the button is clicked
        button.addEventListener("click", function () {
            menu.classList.toggle("hidden");
        });

        // Close the dropdown menu when clicking outside of it
        window.addEventListener("click", function (event) {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add("hidden");
            }
        });
    });

    const logoutUser = () => {
        fetch('../backend/api/logout.php', {
            method: 'POST'
        })
            .then((res) => {
                // If logout is successful, update the isLoggedIn variable and redirect to the login page
                if (res.ok) {
                    isLoggedIn = false; // Update isLoggedIn variable
                    // Redirect to the login page
                    window.location.href = '../index.php';
                } else {
                    // Handle error if logout fails
                    console.error('Logout failed');
                }
            })
            .catch(error => {
                // Handle any network or other errors
                console.error('Error during logout:', error);
            });
    };
</script>