<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <nav class="bg-white border-b border-gray-300 p-4 flex items-center justify-between shadow-md">
        <div class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-2">
            <span class="text-xl font-bold">Instagram</span>
        </div>

        <div class="flex items-center">
            <div class="relative">
                <input type="text" class="border border-gray-300 rounded-md p-2 pl-8" placeholder="Search...">
                <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">

                </div>
            </div>
        </div>

    </nav>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer"
        id="userGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        fetch('../../backend/api/getAllUsers.php')
            .then(response => response.json())
            .then(data => {
                // Log the response object in the console
                console.log(data);
                
                // Access and display limited data for each user
                const userGrid = document.getElementById('userGrid');
                data.forEach(user => {
                    const card = document.createElement('div');
                    card.classList.add('bg-white', 'rounded-md', 'overflow-hidden', 'shadow-md', 'p-6', 'flex', 'flex-col');
                    card.innerHTML = `
                        <div class="flex justify-center">
                            <img src="${user.profile_photo}" height="150" width="150" class="rounded-full">
                        </div>
                        <p class="text-xl font-semibold flex justify-center">${user.username}</p>
                        <p class="text-gray-600 flex justify-center">${user.bio}</p>
                        <div class="flex flex-row justify-evenly mt-7">
                            <div class="flex flex-col">
                                <p class="text-gray-600 font-semibold ml-7">${user.followers}</p>
                                <p class="font-semibold text-xl mb-2">Followers</p>
                            </div>
                            <div class="flex flex-col ml-6">
                                <p class="text-gray-600 font-semibold ml-5">${user.posts}</p>
                                <p class="font-semibold text-xl mb-2">Posts</p>
                            </div>
                        </div>

                    `;
                    userGrid.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>
