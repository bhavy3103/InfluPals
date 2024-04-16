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
    <nav class="bg-white border-b border-gray-300 p-4 flex items-center justify-between shadow-md">
        <div class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-2" alt="instagram">
            <span class="text-xl font-bold">Instagram</span>
        </div>

        <div class="flex items-center">
            <div class="relative">
                <input type="text" id="searchInput" class="border border-gray-300 rounded-md p-2 pl-8 w-80 mr-2" placeholder="Search by name" onkeyup="searchUsers(event)">
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <button onclick="openLoginPage()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Login As Creator
                </button>
                <a href="./page/compare.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Compare</a>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-300 p-4 flex items-center justify-center shadow-md">
        <!-- Sort Options -->
        <div class="flex items-center">
            <button onclick="sortUsers('followers_count')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Followers
            </button>
            <button onclick="sortUsers('media_count')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Posts
            </button>
        </div>

        <!-- Filter options -->
        <div class="relative">
            <button id="filterDropdown" class="flex items-center justify-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                Filter by Follower Count <i class="fas fa-chevron-down ml-2"></i>
            </button>
            <div id="filterDropdownContent" class="hidden absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="filterDropdown">
                    <button class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100" role="menuitem" data-range="0-1000">0 - 1000</button>
                    <button class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100" role="menuitem" data-range="1001-5000">1001 - 5000</button>
                    <button class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100" role="menuitem" data-range="5001-10000">5001 - 10000</button>
                    <button class="filter-option text-gray-700 block w-full px-4 py-2 text-sm text-left hover:bg-gray-100" role="menuitem" data-range="10001-">10001+</button>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer" id="userGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        const category = new URLSearchParams(window.location.search).get('category');

        var sendSingleUserId = (userId) => {
            console.log(userId);
            if (userId !== undefined) {
                // Redirect to profile.php with the user ID as a query parameter
                window.location.href = `page/profile.php?userId=${userId}`;
            } else {
                console.error('User ID is undefined.');
            }
        }

        const openLoginPage = () => {
            location.assign('./page/login.php');
        }
        fetch('../backend/api/getAllUsers.php')
            .then(response => response.json())
            .then(data => {

                // Access and display limited data for each user
                const userGrid = document.getElementById('userGrid');
                data.forEach(user => {
                    if (user.category === category) {
                        const card = document.createElement('div');
                        card.classList.add('bg', 'rounded-md', 'overflow-hidden', 'shadow-md', 'p-6', 'flex', 'flex-col');

                        card.addEventListener('click', () => sendSingleUserId(user.id));

                        card.innerHTML = `
                            <div class="flex justify-center">
                                <img src="${user.profile_picture_url}" height="150" width="150" class="rounded-full" alt="profile">
                            </div>
                            <p class="text-xl font-semibold flex justify-center mt-4">${user.username}</p>
                            <p class="text-gray-600 flex justify-center">${user.biography}</p>
                            <div class="flex flex-row justify-evenly mt-7">
                                <div class="flex flex-col">
                                    <p class="text-gray-600 font-semibold ml-7">${user.followers_count}</p>
                                    <p class="font-semibold text-xl mb-2">Followers</p>
                                </div>
                                <div class="flex flex-col ml-6">
                                    <p class="text-gray-600 font-semibold ml-5">${user.media_count}</p>
                                    <p class="font-semibold text-xl mb-2">Posts</p>
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

        // Get the button and dropdown content elements
        const button = document.getElementById('filterDropdown');
        const dropdownContent = document.getElementById('filterDropdownContent');

        // Add click event listener to the button
        button.addEventListener('click', function() {
            // Toggle the 'hidden' class on the dropdown content element
            dropdownContent.classList.toggle('hidden');
        });

        function renderUsersFromAPI(data) {
            const userGrid = document.getElementById('userGrid');
            userGrid.innerHTML = ''; // Clear existing content

            data.forEach(user => {
                if (user.category === category) {
                    const card = document.createElement('div');
                    card.classList.add('bg', 'rounded-md', 'overflow-hidden', 'shadow-md', 'p-6', 'flex', 'flex-col');

                    card.addEventListener('click', () => sendSingleUserId(user.id));

                    card.innerHTML = `
                <div class="flex justify-center">
                    <img src="${user.profile_picture_url}" height="150" width="150" class="rounded-full" alt="profile">
                </div>
                <p class="text-xl font-semibold flex justify-center mt-4">${user.username}</p>
                <p class="text-gray-600 flex justify-center">${user.biography}</p>
                <div class="flex flex-row justify-evenly mt-7">
                    <div class="flex flex-col">
                        <p class="text-gray-600 font-semibold ml-7">${user.followers_count}</p>
                        <p class="font-semibold text-xl mb-2">Followers</p>
                    </div>
                    <div class="flex flex-col ml-6">
                        <p class="text-gray-600 font-semibold ml-5">${user.media_count}</p>
                        <p class="font-semibold text-xl mb-2">Posts</p>
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
                        return `${user.username}`.toLowerCase().includes(searchTerm);
                    });

                    renderUsersFromAPI(filteredUsers);
                })
                .catch(error => console.error('Error fetching data:', error));

        }

        // Function to filter users based on follower count range
        function filterByFollowerCountRange(min, max) {

            fetch('../backend/api/getAllUsers.php')
                .then(response => response.json())
                .then(data => {

                    const filteredUsers = data.filter(user => {
                        if (min >= 10001) {
                            return `${user.followers_count}` >= min;
                        } else {
                            return `${user.followers_count}` >= min && `${user.followers_count}` <= max;
                        }
                    });

                    renderUsersFromAPI(filteredUsers);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Add click event listeners to the filter options
        const filterOptions = dropdownContent.querySelectorAll('.filter-option');
        filterOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Get the selected range from the data attribute
                const range = this.getAttribute('data-range');
                // Extract min and max values from the range
                const [min, max] = range.split('-').map(Number);
                // Filter users based on the selected range
                filterByFollowerCountRange(min, max);
                // Hide the dropdown after selecting a range
                dropdownContent.classList.add('hidden');
            });
        });
    </script>
</body>

</html>