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
                <button onclick="openLoginPage()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login As Creator
                </button>
                <!-- <a href="./page/compare.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compare</a> -->

            </div>
        </div>

    </nav>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer" id="categoryGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        const openLoginPage = () => {
            location.assign('./page/login.php');
        }

        var openCategoryCards = (category) => {
            if (category !== undefined) {
                window.location.href = `cards.php?category=${category}`;
            } else {
                console.error('Category is undefined.');
            }
        }

        fetch('../backend/api/getAllCategories.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Access and display limited data for each user
                const categoriesGrid = document.getElementById('categoryGrid');
                data.forEach(category => {
                    const card = document.createElement('div');
                    card.classList.add('grid', 'grid-cols-5', 'gap-4', 'mb-6');

                    card.addEventListener('click', () => openCategoryCards(category[1]));

                    card.innerHTML = `
                    <a href="./cards.php?category=${category[1]}">
                        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-xl bg-clip-border rounded-xl w-72">
                            <div class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-xl bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                                <img src="${category[2]}" alt="card-image" />
                            </div>
                            <div class="p-3">
                                <h5 class="block mt-2 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 md:text-center">
                                    ${category[1].toUpperCase()}
                                </h5>

                            </div>
                        </div>
                        </a>`;
                    categoriesGrid.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>