<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            font-family: "Poppins", sans-serif;
        }

        .bg {
            background-color: rgb(252, 250, 250);
        }

        .profile {
            height: 160px;
            width: 160px;
            border-radius: 50%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
        }
    </style>
</head>

<body>
    <?php
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $flag = false;
    $isflag = true;
    $isCompare = true;
    include './utils/navbar.php';
    ?>

    <div class="bg-white border-b border-gray-300 p-4 shadow-md flex items-center justify-between">

        <!-- Filter options -->
        <div class="left-1 flex items-center">
            <label for="minFollowers" class="mr-2">Min Followers:</label>
            <input type="text" id="minFollowers" name="minFollowers"
                class="border border-gray-300 rounded-md p-2 w-24 mr-2" placeholder="0">

            <label for="maxFollowers" class="mr-2">Max Followers:</label>
            <input type="text" id="maxFollowers" name="maxFollowers"
                class="border border-gray-300 rounded-md p-2 w-24 mr-4" placeholder="0">

            <button onclick="filterUsers(event)" id="filterButton"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button onclick="removeFilter()" id="filterButton"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                Remove Filter
            </button>
        </div>

        <!-- Sort Options -->
        <div class="right-1 flex items-center">
            <div class="mr-4">
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover"
                    class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-md px-4 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Pricing Filter<svg class="w-2.5 h-2.5 ml-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="filterDropdownContent"
                    class="hidden absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="filterDropdown">
                        <button
                            class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100"
                            role="menuitem" data-range="0-500"><i
                                class="fa-solid fa-indian-rupee-sign text-gray-4700"></i>0 - 500 </button>
                        <button
                            class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100"
                            role="menuitem" data-range="501-1000"> <i class="fa-solid fa-indian-rupee-sign"></i>501 -
                            1000</button>
                        <button
                            class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100"
                            role="menuitem" data-range="1001-1500"> <i class="fa-solid fa-indian-rupee-sign"></i>1001 -
                            1500</button>
                        <button
                            class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100"
                            role="menuitem" data-range="1501-"> <i class="fa-solid fa-indian-rupee-sign"></i>
                            1501+</button>
                    </div>
                </div>
            </div>

            <button onclick="sortUsers('followers_count')"
                class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Followers
            </button>
            <button onclick="sortUsers('media_count')"
                class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Posts
            </button>
        </div>

    </div>

    <div class="grid grid-cols-auto sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2 mt-8 mr-2 ml-2 mb-4 cursor-pointer"
        id="userGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        //Dropdown for pricing
        const dropdownButton = document.getElementById('dropdownDefaultButton');
        const dropdownMenu = document.getElementById('filterDropdownContent');

        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        const category = new URLSearchParams(window.location.search).get('category');

        function handleUserCardClick(event) {
            // Check if the clicked element is a checkbox
            if (!event.target.classList.contains('compare-checkbox')) {
                // Find the nearest parent that contains the user ID data attribute
                const userCard = event.target.closest('.user-card');
                if (userCard) {
                    // Get the user ID from the data attribute
                    const userId = userCard.dataset.userid;
                    // Redirect to the user's profile page
                    window.location.href = `./page/profile.php?userId=${userId}`;
                }
            }
        }

        var sendSingleUserId = (userId) => {
            // console.log("Original userId:", userId); // Log the original userId
            // Convert userId to a string
            const userIdString = String(userId);
            // Check if userIdString is a valid number
            if (!isNaN(userIdString)) {
                // Subtract 1 from userIdString
                // const newUserId = String(BigInt(userIdString) - BigInt(1));
                // console.log("New userId:", newUserId); // Log the new userId
                // Redirect to profile.php with the new user ID as a query parameter
                // window.location.href = `./page/profile.php?userId=${newUserId}`;
                window.location.href = `./page/profile.php?userId=${userIdString}`;
            } else {
                console.error('User ID is not a valid number.');
            }


        }
        const openLoginPage = () => {
            location.assign('./auth/login.php');
        }

        function compareSelectedUsers() {
            const checkboxes = document.querySelectorAll('.compare-checkbox:checked');
            const selectedUserIds = Array.from(checkboxes).map(checkbox => checkbox.dataset.userid);

            if (selectedUserIds.length === 2) {
                // Redirect to the compare page with selected user IDs as query parameters
                window.location.href = `./page/compare.php?userId1=${selectedUserIds[0]}&userId2=${selectedUserIds[1]}`;
            } else {
                alert('Please select exactly 2 users to compare.');
            }
        }

        fetch('../backend/api/getAllUsers.php')
            .then(response => response.json())
            .then(data => {

                // Access and display limited data for each user
                const userGrid = document.getElementById('userGrid');
                data.forEach(user => {
                    if (user.category === category) {
                        const card = document.createElement('div');
                        card.classList.add('bg', 'rounded-md', 'shadow-xl', 'overflow-hidden', 'p-2', 'flex', 'flex-col');
                        card.style.maxWidth = '450px';

                        card.innerHTML = `
                        <div class="flex flex-col m-2" style="max-width: 450px;">
                            <input type="checkbox" class="compare-checkbox h-5 w-5" data-userid="${user.id}">
                            <div onclick="sendSingleUserId(${user.id})">
                                <div class="flex justify-center">
                                    <img src="${user.profile_picture_url}" class="profile shadow-xl" alt="profile" onclick="sendSingleUserId(${user.id})">
                                </div>
                                <p class="text-lg font-bold flex justify-center mt-4">${user.username}</p>
                                <p class="text-gray-600 flex justify-center mt-3 md:text-center mb-2 biography" style="height: 50px; overflow: hidden;">${user.biography.length > 40 ? user.biography.substring(0, 40) + '...' : user.biography}</p>

                                <div class="flex flex-row justify-evenly mt-2">
                                    <div class="flex flex-col">
                                        <p class="text-gray-600 font-semibold md:text-center">${user.followers_count}</p>
                                        <p class="font-semibold text-xl mb-1">Followers</p>
                                    </div>
                                    <div class="flex flex-col ml-6">
                                        <p class="text-gray-600 font-semibold md:text-center">${user.media_count}</p>
                                        <p class="font-semibold text-lg mb-1">Posts</p>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center text-center align-center mt-3 ">
                                        <p class="font-semibold text-lg mb-1 mr-2">Price per Post : </p>
                                        <p class="text-gray-600 font-semibold md:text-center"><i class="fa-solid fa-indian-rupee-sign"></i> ${user.pricing.feed_post}</p>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <div class="flex justify-center items-center text-gray-600 text-center align-center mt-1 mb-2">
                                    <div>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>${user.location}</span>
                                    </div>
                                    </div> 
                                </div>
                            </div>
                        </div>

                            `;
                        userGrid.appendChild(card);
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        // Variable to store the current sorting criteria and order
        let sortBy = '';
        let sortOrder = 'asc';
        let searchQuery = '';

        function renderUsersFromAPI(data) {
            const userGrid = document.getElementById('userGrid');
            userGrid.innerHTML = ''; // Clear existing content

            data.forEach(user => {
                if (user.category === category) {
                    // console.log(data);
                    const card = document.createElement('div');
                    card.classList.add('bg', 'rounded-md', 'overflow-hidden', 'shadow-xl', 'p-2', 'flex', 'flex-col');
                    card.style.maxWidth = '450px';
                    card.innerHTML = `
                    <div class="flex flex-col m-2" style="max-width: 450px;">
                            <input type="checkbox" class="compare-checkbox h-5 w-5" data-userid="${user.id}">
                            <div onclick="sendSingleUserId(${user.id})">
                                <div class="flex justify-center">
                                    <img src="${user.profile_picture_url}" class="profile shadow-xl" alt="profile" onclick="sendSingleUserId(${user.id})">
                                </div>
                                <p class="text-lg font-bold flex justify-center mt-4">${user.username}</p>
                                <p class="text-gray-600 flex justify-center mt-3 md:text-center mb-2 biography" style="height: 50px; overflow: hidden;">${user.biography.length > 40 ? user.biography.substring(0, 40) + '...' : user.biography}</p>

                                <div class="flex flex-row justify-evenly mt-2">
                                    <div class="flex flex-col">
                                        <p class="text-gray-600 font-semibold md:text-center">${user.followers_count}</p>
                                        <p class="font-semibold text-xl mb-1">Followers</p>
                                    </div>
                                    <div class="flex flex-col ml-6">
                                        <p class="text-gray-600 font-semibold md:text-center">${user.media_count}</p>
                                        <p class="font-semibold text-lg mb-1">Posts</p>
                                    </div>
                                </div>
                                <div class="flex justify-center items-center text-center align-center mt-3 ">
                                        <p class="font-semibold text-lg mb-1 mr-2">Price per Post : </p>
                                        <p class="text-gray-600 font-semibold md:text-center"> <i class="fa-solid fa-indian-rupee-sign"></i> ${user.pricing.feed_post}</p>
                                </div>
                                <div class="flex flex-col mb-2">
                                    <div class="flex justify-center items-center text-gray-600 text-center align-center mt-1 mb-2">
                                    <div>
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span>${user.location}</span>
                                    </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    `;
                    userGrid.appendChild(card);
                }
            });
        }

        // Sorting function
        function sortUsers(criteria) {

            if (sortBy === criteria) {
                // Toggle sorting order
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                // Update sorting criteria
                sortBy = criteria;
                // Default to ascending order when changing criteria
                sortOrder = 'asc';
            }

            fetch('../backend/api/getAllUsers.php')
                .then(response => response.json())
                .then(data => {

                    data.sort((a, b) => {
                        if (criteria === 'followers_count') {
                            return sortOrder === 'asc' ? `${a.followers_count}` - `${b.followers_count}` : `${b.followers_count}` - `${a.followers_count}`;
                        } else if (criteria === 'media_count') {
                            return sortOrder === 'asc' ? `${a.media_count}` - `${b.media_count}` : `${b.media_count}` - `${a.media_count}`;
                        }
                    });
                    renderUsersFromAPI(data);
                    document.getElementById('minFollowers').value = ""
                    document.getElementById('maxFollowers').value = ""
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Search function
        function searchUsers(event) {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            fetch('../backend/api/getAllUsers.php')
                .then(response => response.json())
                .then(data => {

                    const filteredUsers = data.filter(user => {
                        return `${user.username}`.toLowerCase().includes(searchTerm) || `${user.location}`.toLowerCase().includes(searchTerm) || `${user.name}`.toLowerCase().includes(searchTerm);
                    });

                    renderUsersFromAPI(filteredUsers);
                    document.getElementById('minFollowers').value = ""
                    document.getElementById('maxFollowers').value = ""
                })
                .catch(error => console.error('Error fetching data:', error));

        }

        // Add click event listeners to the filter options
        const filterOptions = filterDropdownContent.querySelectorAll('.filter-option');
        filterOptions.forEach(option => {
            option.addEventListener('click', function () {
                // Get the selected range from the data attribute
                const range = this.getAttribute('data-range');
                // Extract min and max values from the range
                const [min, max] = range.split('-').map(Number);
                // Filter users based on the selected range
                filterByFollowerCountRange(min, max);
                // Hide the dropdown after selecting a range
                filterDropdownContent.classList.add('hidden');
            });
        });

        // Function to filter users based on follower count range
        function filterByFollowerCountRange(min, max) {
            fetch('../backend/api/getAllUsers.php').then(response => response.json())
                .then(user => {
                    const filteredUsers = user.filter(user => {
                        if (min >= 1501) {
                            return user.pricing.feed_post >= min;
                        } else {
                            return user.pricing.feed_post >= min && user.pricing.feed_post <= max;
                        }
                    });

                    // users = filteredUsers
                    renderUsersFromAPI(filteredUsers);
                });
        }

        function filterUsers(event) {

            let min = document.getElementById('minFollowers').value;
            let max = document.getElementById('maxFollowers').value;

            if ((isNaN(min) || min <= -1 || min == "") && (isNaN(max) || max <= -1 || max == "")) {
                alert("Please enter either minimum or maximum or both range of followers");
                return;
            }
            min = parseInt(min)
            max = parseInt(max)

            if (min > max) {
                alert("Please enter valid range of followers");
                return;
            }

            fetch('../backend/api/getAllUsers.php')
                .then(response => response.json())
                .then(data => {
                    const filteredUsers = data.filter(user => {
                        const followersCount = parseInt(user.followers_count);
                        if (isNaN(max)) {
                            return followersCount >= min;
                        } else if (isNaN(min)) {
                            return followersCount <= max;
                        } else {
                            return followersCount >= min && followersCount <= max;
                        }
                    });
                    renderUsersFromAPI(filteredUsers);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function removeFilter() {
            // Code to remove filter and render all users
            fetch('../backend/api/getAllUsers.php')
                .then(response => response.json())
                .then(data => {
                    renderUsersFromAPI(data);
                    document.getElementById('minFollowers').value = ""
                    document.getElementById('maxFollowers').value = ""
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    </script>
</body>

</html>