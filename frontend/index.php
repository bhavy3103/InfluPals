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
    $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    $flag = true;
    $isflag = false;
    $isCompare = false;
    include './utils/navbar.php';
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8 mx-4 mb-8 cursor-pointer"
        id="categoryGrid">
        <!-- User cards will be added here dynamically -->
    </div>

    <script>
        const openLoginPage = () => {
            location.assign('./auth/login.php');
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