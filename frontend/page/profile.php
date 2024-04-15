<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/5014f23600.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fe2fdff340.js" crossorigin="anonymous"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        Seafoamgreen: '#66A5AD',
                        lightblue: '#C4DFE6',
                    }
                }
            }
        }
    </script>
    <style>
        nav {
            z-index: 1;
        }

        #bar {
            display: flex !important;
            justify-content: space-evenly;
        }

        #bar>div {
            width: 30%;
        }

        #bioSection {
            /* background: skyblue; */
            padding: 20px;
            margin-top: -20px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-white-200">
    <!-- <div class="bg-sky-100"> -->
    <nav class="bg-white sticky top-0 border-b border-gray-300 p-4 flex items-center justify-between shadow-lg ">
        <div class="flex items-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" class="h-8 mr-2">
            <span class="text-2xl font-extrabold text-blue-800 uppercase">Instagram</span>
        </div>

        <div class="">
            <div class="space-x-3 pe-200">
                <a href="../index.php" class="text-blue-900 hover:bg-orange-400 hover:text-blue-800 rounded-md px-3 py-2 text-lg font-medium">Home</a>
                <a href="" class="text-blue-900 hover:bg-orange-400 hover:text-blue-800 rounded-md px-3 py-2 text-lg font-medium">Insights</a>
                <a href="" class="text-blue-900 hover:bg-orange-400 hover:text-blue-800 rounded-md px-3 py-2 text-lg font-medium">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto py-12 px-8 flex flex-col text-blue-900">
        <!-- Bio -->
        <span class="bg-slate-200 rounded-lg shadow-lg p-8">
            <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-16 " id="bioSection">
                <!-- The content will be dynamically set here -->
            </div>

            <!-- modal -->
            <div class="flex justify-center items-center gap-6">
                <div>
                    <button onclick="showDialog()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                        Pricing Details
                    </button>

                    <!-- pop-up -->
                    <div id="price-modal" class="hidden bg-white shadow-xl  border fixed rounded-xl left-[30%] top-[20%] w-[40vw] max-h-[60vh] z-30 overflow-y-hidden overflow-x-hidden flex justify-center items-center">
                        <div class="relative rounded-lg">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between py-2 px-4 md:p-5 border-b">
                                <div class="text-xl text-center font-semibold text-gray-800">
                                    Pricing
                                </div>
                                <button onclick="showDialog()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <!-- body -->
                            <div id="pricing_block">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button onclick="showBookNow()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                        Book Now
                    </button>
                    <div
                        id="book-now"
                        class="hidden bg-white fixed inset-0 fixed left-[20%] w-[60vw] h-[80vh] top-[10%] z-30 overflow-y-auto overflow-x-hidden flex justify-center items-center">
                        <form action="../../backend/api/booking.php" method="post" id="booking_form">
                            <div class="heading text-center text-3xl text-indigo-600 font-medium">Add Your Requirnments
                                <!-- <hr class="mx-4 mt-3 border-indigo-400" style="width: 20%; height: 10px; margin: 0 auto;"> -->
                            </div>

                            <div class="row mb-3 mx-4 mt-11 ">
                                <label for="name" class="col-sm-3 col-form-label font-medium text-xl">Name : </label>
                                <div class="col-sm-9">
                                    <input type="text" min="0" class="form-control" name="name" id="name" required>
                                </div>
                            </div>

                            <div class="row mb-3 mx-4 mt-3">
                                <label for="email" class="col-sm-3 col-form-label font-medium text-xl">Email :</label>
                                <div class="col-sm-9">
                                    <input type="email" min="0" class="form-control" name="email" id="email" required>
                                </div>
                            </div>

                            <div class="row mb-3 mx-4 mt-3">
                                <label for="contact" class="col-sm-3 col-form-label font-medium text-xl">Contact :</label>
                                <div class="col-sm-9">
                                    <input type="tel" min="0" class="form-control" name="contact" id="contact" required>
                                </div>
                            </div>

                            <div class="row mb-3 mx-4 mt-3">
                                <label for="requirnments" class="col-sm-3 col-form-label font-medium text-xl">Requisite:</label>
                                <div class="col-sm-9">
                                    <textarea name="requirements" id="requirements" cols="30" rows="10" class="form-control"
                                        style="resize: none; height: 150px;" placeholder="60s reel with voiceover and good video shots."
                                        required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3 mx-4 mt-3">
                                <label for="budget" class="col-sm-3 col-form-label font-medium text-xl">Budget :</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" class="form-control" name="budget" id="budget" required>
                                </div>
                            </div>

                            <!-- <div class="text-gray-600 flex justify-center">
                                * Above price is based on per individual element
                            </div> -->

                            <div class="mt-3 pr-4 flex items-center justify-center gap-x-6">
                                <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="my-8 border-gray-300">

            <!-- Followers Demographics -->
            <h2 class="text-3xl pb-3 text-orange-400 font-medium">Followers Demographics</h2>
            <div id="bar" class="w-full bg-white rounded-lg shadow-lg p-8 chart_container" style="height: 375px; display: block; ">
                <div class="chart_wrapper" id="ageChart"></div>
                <div class="chart_wrapper" id="genderChart"></div>
                <div class="chart_wrapper" id="cityChart"></div>
                <!-- <div class="chart_wrapper" id="stateChart"></div> -->
            </div>

            <hr class="my-8 mt-14 border-gray-300">

            <!-- Posts -->
            <h2 class="text-3xl pb-3 text-orange-400 font-medium">Recent Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 bg-white rounded-lg shadow-lg p-8" id="postsSection">
                <!-- The content will be dynamically set here -->
            </div>
        </span>
    </div>

    <script>
        let user = {};
        
        let isHide=true;
        let isHideBookNow=true;
        const showDialog=()=>{
            console.log(isHide);
            isHide=!isHide;
            const modal=document.getElementById('price-modal');
            if(isHide){
                modal.style.display="none";
            }
            else{
                modal.style.display="block";
            }
        }
        const showBookNow=()=>{
            isHideBookNow=!isHideBookNow;
            const modal=document.getElementById('book-now');
            if(isHideBookNow){
                modal.style.display="none";
            }
            else{
                modal.style.display="block";
            }
        }
        const profileData = () => {
            // Example: Dynamically set bio section
            const bioSection = document.getElementById('bioSection');
            bioSection.innerHTML = `
            <div class="flex-shrink-0 ">
            <img src="${user.profile_picture_url}" class="rounded-full shadow-lg w-48 h-48 mx-8" alt="User_logo">
            <p class="text-4xl mt-4 lg:mt-3 lg:text-center lg:text-4xl font-bold">${user.name}</p>
                </div>
                <div class="mt-8 lg:mt-200 my-100">
                    <div class="flex items-center space-x-4 mt-8">
                        <p class="text-2xl font-bold font-medium">${user.username}</p>
                        <p class="text-blue-500">|</p>
                        <p class="text-blue-500">${user.category || 'general'}</p>
                    </div>
                    <div class="flex mt-4 space-x-4 ">
                        <a href="#posts">
                        <div class="bg-white text-lg text-center rounded-md p-4 item-center w-32">
                            <p class="font-bold text-2xl">${user.media_count}</p>
                            <p class="text-orange-400 font-medium">Posts</p>
                        </div></a>
                        <div class="bg-white text-lg text-center rounded-md p-4 item-center w-32">
                            <p class="font-bold text-2xl">${user.followers_count}</p>
                            <p class="text-orange-400 font-medium">Followers</p>
                        </div>
                        <div class="bg-white text-lg text-center rounded-md p-4 item-center w-32">
                            <p class="font-bold text-2xl">${user.media_count}</p>
                            <p class="text-orange-400 font-medium">Impression</p>
                        </div>
                        <div class="bg-white text-lg text-center rounded-md p-4 item-center w-35">
                            <p class="font-bold text-2xl">${user.followers_count}</p>
                            <p class="text-orange-400 font-medium">Profile Views</p>
                        </div>                        
                        
                    </div>
                    
                    <div class="mt-4">
                        <p class="text-lg text-blue-500">${user.biography}</p>
                    </div>
                </div>      
            `;

            // pricing
            const pricingSection = document.getElementById('pricing_block');
            pricingSection.innerHTML=`
                <div class="justify-center border px-8 py-4 overflow-y-scroll">
                    <div class="my-4 flex gap-4">
                        <div for="post" class="text-xl font-medium text-gray-700">Story</div>
                        <div id="story">₹ ${user.pricing.story} / story</div>
                    </div>
                    <div class="my-4 flex gap-4">
                        <div for="post" class="text-xl font-medium text-gray-700">IGTV Video</div>
                        <div id="igtv_video">₹ ${user.pricing.igtv_video} / igtv video</div>
                    </div>
                    <div class="my-4 flex gap-4">
                        <div for="post" class="text-xl font-medium text-gray-700">Reel</div>
                        <div id="reel">₹ ${user.pricing.reel} / reel</div>
                    </div>
                    <div class="my-4 flex gap-4">
                        <div for="post" class="text-xl font-medium text-gray-700">Live Stream</div>
                        <div id="live_stream">₹ ${user.pricing.live_stream} / live stream</div>
                    </div>
                    <div class="my-4 flex gap-4">
                        <div for="post" class="text-xl font-medium text-gray-700">Feed Post</div>
                        <div id="feed_post">₹ ${user.pricing.feed_post} / feed post</div>
                    </div>
                    
                    <div class="border-t"></div>
                    <div class="my-4">
                    <button class="block text-white text-center mx-auto bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                    </div>
                </div>
            `
            
            //Animate to posts smoothly
            document.querySelectorAll('a[href^="#post"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Example: Dynamically set recent posts section
            const postsSection = document.getElementById('postsSection');
            postsSection.innerHTML = user.media.map(post => `
                <div onclick="openMedia('${post.permalink}')" class="border-2 border-gray-500 rounded-md overflow-hidden cursor-pointer" id="posts">    
                    <img src="${post.media_type=='IMAGE' ? post.media_url : post.thumbnail_url}" alt="" class="w-full">
                    <div class="p-4 flex bg-gray-100 justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <i class="far fa-heart"></i>
                            <p>${formatCount(post.like_count)}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="far fa-comment"></i>
                            <p>${formatCount(post.comments_count)}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        const openMedia = (media_url) => {
            window.open(media_url, "_blank");
        }

        const createCharts = () => {

            const sortedResults = user.demographicsCity.sort((a, b) => b.value - a.value);
            sum = 0
            sortedResults.slice(7, sortedResults.length).map(i => i.value).forEach(i => {
                sum += i
            })
            // Take the top 10 cities
            const top10Results = sortedResults.slice(0, 7);
            // Extract labels and data for the top 10 cities
            const top10Labels = top10Results.map(i => i.dimension_values[0].split(',')[0]);
            top10Labels.push("Others")
            const top10Data = top10Results.map(i => i.value);
            top10Data.push(sum)

            // Age Distribution Chart
            age = user.demographicsAge.map(ele => ele.value)
            const ageData = {
                x: user.demographicsAge.map(ele => ele.dimension_values[0]),
                y: user.demographicsAge.map(ele => ele.value),
                type: 'bar',
                marker: {
                    color: 'rgb(24, 46, 112)'
                },
                name: 'Age vise Followers',
                text: user.demographicsAge.map(ele => ele.value),
                textposition: 'auto',
                hoverinfo: 'x+text',
                opacity: 0.8,
            };
            const ageLayout = {
                xaxis: {
                    title: 'Age',
                    color: 'red'
                },
                yaxis: {
                    title: 'Total number of Followers',
                    color: 'red'
                },
                title: {
                    text: 'Age Wise Distribution',
                    font: {
                        size: 24,
                    }
                },
                showlegend: false,
            };

            // City Distribution Chart
            const cityData = {
                y: top10Labels,
                x: top10Data,
                type: 'bar',
                marker: {
                    color: 'rgb(11, 153, 51)'
                },
                name: 'City vise Followers',
                orientation: 'h',
                text: top10Data,
                textposition: 'auto',
                hoverinfo: 'y+text',
                opacity: 0.8,
            };
            const cityLayout = {
                xaxis: {
                    title: 'Total number of Followers',
                    color: 'red'
                },
                yaxis: {
                    title: 'City',
                    color: 'red'
                },
                title: {
                    text: 'City Wise Distribution',
                    font: {
                        size: 24,
                    }
                },
                showlegend: false,
            };

            // Gender Distribution Chart
            const genderData = {
                values: user.demographicsGender.map(ele => ele.value),
                labels: user.demographicsGender.map(ele => {
                    if (ele.dimension_values[0] === 'M') {
                        return 'Male';
                    } else if (ele.dimension_values[0] === 'F') {
                        return 'Female';
                    } else {
                        return 'Undefined';
                    }
                }),
                type: 'pie',
                hoverinfo: 'label+percent',
                name: 'Gender vise follower count',

            };
            const genderLayout = {
                title: {
                    text: 'Gender Wise Distribution',
                    font: {
                        size: 24,
                    }
                },
                legend: {
                    font: {
                        size: 16,
                    }
                }
            };

            // Plot charts
            Plotly.newPlot('ageChart', [ageData], ageLayout);
            Plotly.newPlot('genderChart', [genderData], genderLayout);
            Plotly.newPlot('cityChart', [cityData], cityLayout);

            Plotly.newPlot('ageChart', [ageData], ageLayout, {
                displayModeBar: false
            });
            Plotly.newPlot('genderChart', [genderData], genderLayout, {
                displayModeBar: false
            });
            Plotly.newPlot('cityChart', [cityData], cityLayout, {
                displayModeBar: false
            });
        };

        const userId = new URLSearchParams(window.location.search).get('userId');
        console.log('User ID in profile.php:', userId);

        function formatCount(count) {
            if (count >= 1000000) {
                return (count / 1000000).toFixed(1) + 'M';
            } else if (count >= 1000) {
                return (count / 1000).toFixed(1) + 'k';
            } else {
                return count.toString();
            }
        }

        const fetchapi = async (userId) => {
            try {
                const response = await fetch('../../backend/api/getSingleUser.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id: userId
                    }),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                user = await response.json();
                console.log(user);

                // Pass the data to the function that creates the charts
                profileData();
                createCharts();
            } catch (error) {
                console.error('Error:', error);
            }
        };
        fetchapi(userId);
    </script>
</body>

</html>