<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://kit.fontawesome.com/5014f23600.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5014f23600.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #bar {
            display: flex !important;
            flex-direction: row !important;
        }
        #bar>canvas {
            width: 33% !important;
            height: 100% !important;
            margin: 20px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-16 px-8">
        <!-- Bio -->
        <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-16">
            <div class="flex-shrink-0">
                <img src="./user.jpg" class="rounded-full shadow-lg w-48 h-48" alt="User_logo">
                <p class="text-4xl mt-4 lg:mt-3 lg:ms-7 lg:text-4xl lg:ml-12">John Doe</p>
            </div>

            <div class="mt-8 lg:mt-6">
                <div class="flex items-center space-x-4">
                    <p class="text-2xl font-bold">john_doe_00</p>
                    <p class="text-gray-500">|</p>
                    <p class="text-gray-500">Digital Creator</p>
                </div>

                <div class="flex mt-4">
                    <div class="flex items-center space-x-4">
                        <p class="font-bold">70</p>
                        <p>Posts</p>
                    </div>
                    <div class="flex items-center space-x-4 ml-8">
                        <p class="font-bold">3756</p>
                        <p>Followers</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-lg">Passionate digital creator sharing creativity & inspiration through photos, videos, and design. Collaborating with brands, building communities, and sparking joy. Join the journey!</p>
                </div>
            </div>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Followers Demographics -->
        <h2 class="text-3xl pb-3">Followers Demographics</h2>
        <div id="bar" class="w-full" style="height: 375px; display: block;">
            <canvas id="myChart"></canvas>
            <canvas id="barChart2"></canvas>
            <canvas id="pieChart"></canvas>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Posts -->
        <h2 class="text-3xl pb-3">Recent Posts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
            <div class="border-2 border-gray-500 rounded-md overflow-hidden">
                <img src="post.jpg" alt="" class="w-full">
                <div class="p-4 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <i class="far fa-heart"></i>
                        <p>1.4K</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="far fa-comment"></i>
                        <p>2546</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        const ctx = document.getElementById('myChart');
        const mf = document.getElementById('pieChart');
        const city = document.getElementById('barChart2');

        fetch('ageData.json')
            .then(response => response.json())
            .then(data => {
                new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(data.age),
                            datasets: [{
                                label: 'Total Followers in percentage',
                                data: Object.values(data.age).map(category => category.percentage),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            animation: true
                        }
                    }),
                    new Chart(mf, {
                        type: 'doughnut',
                        data: {
                            labels: Object.keys(data.gender),
                            datasets: [{
                                data: Object.values(data.gender).map(category => category.percentage),
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(2, 205, 86)'
                                ],
                                hoverBackgroundColor: [
                                    'rgb(252, 167, 185)',
                                    'rgb(162, 215, 250)',
                                    'rgb(247, 225, 173)',
                                    'rgb(157, 250, 196)'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            cutout: "50%",
                            radius: "70%",
                            rotation: 1
                        }
                    }),
                    new Chart(city, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(data.city),
                            datasets: [{
                                label: 'City vise Followers',
                                data: Object.values(data.city).map(category => category.total_followers),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            animation: true
                        }
                    });
            })
            .catch(error => console.error('Error fetching JSON:', error));
    </script>

</body>

</html>


<?php

?>