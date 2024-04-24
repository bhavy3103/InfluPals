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
                <button onclick="compareSelectedUsers()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Compare</button>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-300 p-4 shadow-md flex items-center justify-between">

        <!-- Filter options -->
        <div class="left-1 flex items-center">
            <label for="minFollowers" class="mr-2">Min Followers:</label>
            <input type="text" id="minFollowers" name="minFollowers" class="border border-gray-300 rounded-md p-2 w-24 mr-2" placeholder="0">

            <label for="maxFollowers" class="mr-2">Max Followers:</label>
            <input type="text" id="maxFollowers" name="maxFollowers" class="border border-gray-300 rounded-md p-2 w-24 mr-4" placeholder="0">

            <button onclick="filterUsers(event)" id="filterButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button onclick="removeFilter()" id="filterButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-4">
                Remove Filter
            </button>
        </div>

        <!-- Sort Options -->
        <div class="right-1 flex items-center">
            <button onclick="sortUsers('followers_count')" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Followers
            </button>
            <button onclick="sortUsers('media_count')" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Posts
            </button>
        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer" id="userGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
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
        const newUserId = String(BigInt(userIdString) - BigInt(1));
        // console.log("New userId:", newUserId); // Log the new userId
        // Redirect to profile.php with the new user ID as a query parameter
        window.location.href = `./page/profile.php?userId=${newUserId}`;
    } else {
        console.error('User ID is not a valid number.');
    }


}
        const openLoginPage = () => {
            location.assign('./page/login.php');
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
                        // console.log(user.id);
                        const card = document.createElement('div');
                        card.classList.add('bg', 'rounded-md', 'overflow-hidden', 'shadow-xl', 'p-6', 'flex', 'flex-col');

                        card.innerHTML = `
                             <input type="checkbox" class="compare-checkbox h-5 w-5" data-userid="${user.id}">
                            <div class="flex justify-center">
                                <img src="${user.profile_picture_url}" class="profile shadow-xl" alt="profile" onclick="sendSingleUserId(${user.id})">
                            </div>
                            <p class="text-lg font-bold flex justify-center mt-4">${user.username}</p>
                            <p class="text-gray-600 flex justify-center mt-3 md:text-center mb-2">${user.biography}</p>
                            <div class="flex flex-row justify-evenly mt-6">
                                <div class="flex flex-col">
                                    <p class="text-gray-600 font-semibold md:text-center">${user.followers_count}</p>
                                    <p class="font-semibold text-xl mb-1">Followers</p>
                                </div>
                                <div class="flex flex-col ml-6">
                                    <p class="text-gray-600 font-semibold md:text-center">${user.media_count}</p>
                                    <p class="font-semibold text-lg mb-1">Posts</p>
                                </div>
                            </div>
                            <div class="flex flex-col ml-6 mb-2">
                                <p class="text-gray-600 font-semibold md:text-center">${user.location}</p>
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
                    card.classList.add('bg', 'rounded-md', 'overflow-hidden', 'shadow-xl', 'p-6', 'flex', 'flex-col');

                    card.innerHTML = `
                            <div class="flex justify-center">
                                <img src="${user.profile_picture_url}" class="profile shadow-xl" alt="profile" onclick="sendSingleUserId(${user.id})">
                            </div>
                            <p class="text-lg font-bold flex justify-center mt-4">${user.username}</p>
                            <p class="text-gray-600 flex justify-center mt-3 md:text-center mb-2">${user.biography}</p>
                            <div class="flex flex-row justify-evenly mt-6">
                                <div class="flex flex-col">
                                    <p class="text-gray-600 font-semibold md:text-center">${user.followers_count}</p>
                                    <p class="font-semibold text-xl mb-1">Followers</p>
                                </div>
                                <div class="flex flex-col ml-6">
                                    <p class="text-gray-600 font-semibold md:text-center">${user.media_count}</p>
                                    <p class="font-semibold text-lg mb-1">Posts</p>
                                </div>
                                <div class="flex flex-col ml-6">
                                    <p class="text-gray-600 font-semibold md:text-center">${user.location}</p>
                                    <p class="font-semibold text-lg mb-1">location</p>
                                </div>
                            <input type="checkbox" class="compare-checkbox" data-userid="${user.id}">
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
                        return `${user.username}`.toLowerCase().includes(searchTerm);
                    });

                    renderUsersFromAPI(filteredUsers);
                    document.getElementById('minFollowers').value = ""
                    document.getElementById('maxFollowers').value = ""
                })
                .catch(error => console.error('Error fetching data:', error));

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
