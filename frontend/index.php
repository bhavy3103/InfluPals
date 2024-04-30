<?php
session_start();
if (!(isset($_SESSION['id']))) {
    // Redirect to index.php only if the current page is not already index.php
    if (basename($_SERVER['PHP_SELF']) != 'index.php') {
        header("Location: ./index.php");
        exit; // Make sure to exit after redirection
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php
    $isLoggedIn = isset($_SESSION['id']);
    $showAdminDashboardNavigation = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
    $flag = true;
    $showSearchBar = false;
    $showCompareUserButton = false;
    include './utils/index_navbar.php';
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer"
        id="categoryGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        var isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
        console.log(isLoggedIn);

        // Function to handle card click
        var openCategoryCards = (category) => {
            if (isLoggedIn) {
                // If user is logged in, redirect to the card page
                window.location.href = `./page/cards.php?category=${encodeURIComponent(category)}`;
            } else {
                // If user is not logged in, show an alert
                alert("Please login to First!");
            }
        };

        // Fetch categories data and dynamically generate cards
        fetch('../backend/api/getAllCategories.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Access and display limited data for each category
                const categoriesGrid = document.getElementById('categoryGrid');
                data.forEach(category => {
                    const card = document.createElement('div');
                    card.classList.add('grid', 'grid-cols-5', 'gap-4', 'mb-6');

                    // Add event listener to each card
                    card.addEventListener('click', () => openCategoryCards(category[1]));

                    card.innerHTML = `
                    <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-xl bg-clip-border rounded-xl w-72">
                        <div class="relative h-40 mx-4 mt-6 overflow-hidden text-white shadow-xl bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
                            <img src="${category[2]}" alt="card-image" />
                        </div>
                        <div class="p-3">
                            <h5 class="block mt-2 text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 md:text-center">
                                ${category[1].toUpperCase()}
                            </h5>
                        </div>
                    </div>`;
                    categoriesGrid.appendChild(card);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

</body>

</html>