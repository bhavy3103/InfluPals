<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <nav class="bg-white border-b border-gray-300 p-4 flex items-center justify-end shadow-md">
        <div class="absolute left-0 flex items-center justify-start ml-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-2" alt="instagram">
            <span class="text-xl font-bold">Instagram</span>
        </div>

        <!-- Sort Options -->
        <div class="flex items-center">
            <button onclick="sortUsers('followers')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Followers
            </button>
            <button onclick="sortUsers('posts')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                <i class="fas fa-sort"></i> Posts
            </button>
        </div>

        <!-- Filter options -->
        <div class="relative">
            <button id="filterDropdown" class="flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
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

        <div class="flex items-center">
            <div class="relative">
                <input type="text" id="searchInput" class="border border-gray-300 rounded-md p-2 pl-8 w-80" placeholder="Search by name or city" onkeyup="searchUsers(event)">
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- <nav>
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-4">
                <label for="sort-by" class="text-gray-700">Sort By:</label>
                <select id="sort-by" class="border border-gray-300 rounded-md py-1 px-2">
                    <option value="-1">Select field</option>
                    <option value="followers_count">Followers Count</option>
                    <option value="followers_count">City</option>
                    <option value="media_count">Media Count</option>
                    <option value="username">Username</option>
                </select>
                <label for="sort-type" class="text-gray-700">Sort Type:</label>
                <select id="sort-type" class="border border-gray-300 rounded-md py-1 px-2">
                    <option value="-1">Select type</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="flex items-center space-x-4">
                <label for="search-query" class="text-gray-700">Search:</label>
                <input type="text" id="search-query" placeholder="Search by username or biography" class="border border-gray-300 rounded-md py-1 px-2">
                <button onclick="applyFilters()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </div>
        </div>

        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-4">
                <label for="follower-range" class="text-gray-700">Follower Count Range:</label>
                <select id="follower-range" class="border border-gray-300 rounded-md py-1 px-2">
                    <option value="-1">Select Range</option>
                    <option value="0-100">0 - 1000</option>
                    <option value="100-500">1001 - 5000</option>
                    <option value="500-1000">5001 - 10000</option>
                    <option value="1000+">10000+</option>
                </select>
                <label for="city" class="text-gray-700">City:</label>
                <input type="text" id="city" placeholder="Filter by city" class="border border-gray-300 rounded-md py-1 px-2">
            </div>
            <button onclick="applyFilters()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Apply Filters</button>
        </div>
    </nav> -->

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8">

        <!-- <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-1.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Blanche Pearson</p>
            <p class="text-gray-600 flex justify-center">Food</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">290</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">7000</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Delhi</p>
            </div>
        </div>

        <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-2.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Blanche Pearson</p>
            <p class="text-gray-600 flex justify-center">Content Creator</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">2900</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">7000</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Goa</p>
            </div>
        </div>

        <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-3.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Blanche Pearson</p>
            <p class="text-gray-600 flex justify-center">Content Creator</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">900</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">7000</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Ahmedabad</p>
            </div>
        </div>

        <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-4.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Blanche Pearson</p>
            <p class="text-gray-600 flex justify-center">Content Creator</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">9900</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">7000</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Mumbai</p>
            </div>
        </div>

        <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-5.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Blanche Pearson</p>
            <p class="text-gray-600 flex justify-center">Content Creator</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">3500</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">7000</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Abu</p>
            </div>
        </div>

        <div class="bg rounded-md overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="./page/img-6.jpg" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">Kristina Zasiadko</p>
            <p class="text-gray-600 flex justify-center">Content Creator</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">72000</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">5432</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="./page/address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">Hydrabad</p>
            </div>
        </div> -->

    </div>

    <script>
        // Define user data array
        const users = [{
                name: "Blanche Pearson",
                category: "Content creator",
                followers: 290,
                city: "Delhi",
                posts: 700,
                image: "img-3.jpg"
            },
            {
                name: "Blanche Pearson",
                category: "Content creator",
                followers: 2900,
                city: "Goa",
                posts: 70,
                image: "img-3.jpg"
            },
            {
                name: "Blanche Pearson",
                category: "Content creator",
                followers: 900,
                city: "Ahmedabad",
                posts: 500,
                image: "img-3.jpg"
            },
            {
                name: "Blanche Pearson",
                category: "Content creator",
                followers: 9900,
                city: "Mumbai",
                posts: 7000,
                image: "img-3.jpg"
            },
            {
                name: "Blanche Pearson",
                category: "Content creator",
                followers: 3500,
                city: "Abu",
                posts: 100,
                image: "img-3.jpg"
            },
            {
                name: "Kristina Zasiadko",
                category: "Content creator",
                followers: 72000,
                city: "Delhi",
                posts: 5432,
                image: "img-3.jpg"
            }
        ];

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

        // Function to render user cards
        function renderUsers(userData) {
            const grid = document.querySelector('.grid');
            grid.innerHTML = ''; // Clear existing content

            userData.forEach(user => {
                const card = `
        <div class="bg overflow-hidden shadow-md">
            <div class="flex justify-center mt-2">
                <img src="${user.image}" class="profile" alt="profile">
            </div>
            <p class="text-lg font-semibold flex justify-center mt-2">${user.name}</p>
            <p class="text-gray-600 flex justify-center">${user.category}</p>
            <div class="flex flex-row justify-evenly mt-3">
                <div class="flex flex-col">
                    <p class="text-gray-600 font-semibold ml-7">${user.followers}</p>
                    <p class="font-semibold text-xl mb-1">Followers</p>
                </div>
                <div class="flex flex-col ml-6">
                    <p class="text-gray-600 font-semibold ml-1">${user.posts}</p>
                    <p class="font-semibold text-lg mb-1">Posts</p>
                </div>
            </div>
            <div class="flex justify-center text-gray-600 mt-1 mb-2">
                <img src="address-41.svg" height="18" width="18" alt="city">
                <p class="ml-1 city">${user.city}</p>
            </div>
        </div>`;
                grid.innerHTML += card;
            });
        }

        // Initial render
        renderUsers(users);

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

            users.sort((a, b) => {
                if (criteria === 'followers') {
                    return sortOrder === 'asc' ? a.followers - b.followers : b.followers - a.followers;
                } else if (criteria === 'posts') {
                    return sortOrder === 'asc' ? a.posts - b.posts : b.posts - a.posts;
                }
                // else if (criteria === 'name') {
                //     return sortOrder === 'asc' ? a.name.localeCompare(b.name) : b.name.localeCompare(a.name);
                // }
            });

            // Re-render after sorting
            renderUsers(users);
        }

        // Search function
        function searchUsers(event) {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();

            const filteredUsers = users.filter(user => {
                return user.name.toLowerCase().includes(searchTerm) || user.city.toLowerCase().includes(searchTerm);
            });

            // users = filteredUsers
            renderUsers(filteredUsers);
        }

        // Function to filter users based on follower count range
        function filterByFollowerCountRange(min, max) {
            const filteredUsers = users.filter(user => {
                if (min >= 10001) {
                    return user.followers >= min;
                } else {
                    return user.followers >= min && user.followers <= max;
                }
            });

            // users = filteredUsers
            renderUsers(filteredUsers);
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