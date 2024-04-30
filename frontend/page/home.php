<?php
session_start();
if (!(isset($_SESSION['id']))) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAD</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $showAdminDashboardNavigation = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
    $flag = true;
    $showSearchBar = false;
    $showCompareUserButton = false;
    include '../utils/navbar.php';
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer"
        id="categoryGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>

        var openCategoryCards = (category) => {
            if (category !== undefined) {
                window.location.href = `cards.php?category=${category}`;
            } else {
                console.error('Category is undefined.');
            }
        }

        fetch('../../backend/api/getAllCategories.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Access and display limited data for each user
                const categoriesGrid = document.getElementById('categoryGrid');
                const categories = data.categories;
                const categoryFreq = data.categoryFreq;

                categories.forEach(category => {
                    const card = document.createElement('div');
                    card.classList.add('grid', 'grid-cols-5', 'gap-4', 'mb-6');

                    card.addEventListener('click', () => openCategoryCards(category.name));

                    card.innerHTML = `
                        <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-xl bg-clip-border rounded-xl w-72">
                            <div class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-xl bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                                <img src="${category.image_url}" alt="card-image" />
                            </div>
                            <div class="flex justify-between py-3 px-10 items-center">
                                <h5 class="block text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 md:text-center">
                                    ${category.name?.toUpperCase()}
                                </h5>
                                <h5 class="text-xl text-gray-500">${categoryFreq[category.name] || 0}</h5>
                            </div>
                        </div>`;
                    categoriesGrid.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>