<?php
session_start();
if (!(isset($_SESSION['id']) && (strtolower($_SESSION['role']) === 'admin' || strtolower($_SESSION['role']) === 'user')))
    header("Location: ../auth/login.php");
else
    header("Location: index2.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
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
                <button onclick="openLoginPage()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login As Creator
                </button>
            </div>
        </div>

    </nav>


    <div class="grid grid-cols-5 gap-4 mb-6">
        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Lifestyle
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Fitness
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Food
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Fashion
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Makeup
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Art
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>

        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-72">
            <div
                class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="card-image" />
            </div>
            <div class="p-3">
                <h5
                    class="block mt-2 ml-4 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Photography
                </h5>

            </div>
            <div class="p-6 pt-0">
                <button
                    class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button">
                    <a href="./index_filter.php">See More</a>
                </button>
            </div>
        </div>
    </div>



    <script>
        var sendSingleUserId = (userId) => {
            console.log(userId);
            if (userId !== undefined) {
                // Redirect to profile.php with the user ID as a query parameter
                window.location.href = `./profile.php?userId=${userId}`;
            } else {
                console.error('User ID is undefined.');
            }
        }

        const openLoginPage = () => {
            location.assign('./login.php');
        }

        fetch('../backend/api/getAllUsers.php')
            .then(response => response.json())
            .then(data => {
                // Log the response object in the console
                console.log(data);

                sendSingleUserId(data.id);
                // Access and display limited data for each user
                const userGrid = document.getElementById('userGrid');
                data.forEach(user => {
                    const card = document.createElement('div');
                    card.classList.add('bg-white', 'rounded-md', 'overflow-hidden', 'shadow-md', 'p-6', 'flex', 'flex-col');

                    card.addEventListener('click', () => sendSingleUserId(user.id));

                    card.innerHTML = `
                        <div class="flex justify-center">
                            <img src="${user.profile_picture_url}" height="150" width="150" class="rounded-full">
                        </div>
                        <p class="text-xl font-semibold flex justify-center">${user.username}</p>
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
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>