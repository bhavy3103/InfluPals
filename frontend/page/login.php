<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100">
            <div id="loggedInContent" class="w-96 bg-white rounded-lg shadow-md p-6 relative">
                <h2 class="text-lg font-semibold text-center mb-4">Switch Accounts</h2>
                <hr class="mb-4">
                <div id="pagesContainer"></div>
                <div class="flex items-center mb-4 hover:bg-gray-300 cursor-pointer rounded-lg p-2">
                    <img src="profile.jpg" alt="Profile Photo" class="w-10 h-10 rounded-full mr-2">
                    <span class="text-gray-700 font-semibold">_bhavyashah_</span>
                    <button class="absolute right-3.5 mt-7 mr-7 transform -translate-y-1/2 bg-blue-500 text-white rounded-full p-1 hover:bg-blue-600 focus:outline-none">
                        <!-- SVG check icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center mb-4 hover:bg-gray-300 cursor-pointer rounded-lg p-2">
                    <img src="profile.jpg" alt="Profile Photo" class="w-10 h-10 rounded-full mr-2">
                    <span class="text-gray-700 font-semibold">_bhavya_shah</span>
                    <button class="absolute  right-3.5 mt-7 mr-7  transform -translate-y-1/2 bg-blue-500 text-white rounded-full p-1 hover:bg-blue-600 focus:outline-none">
                        <!-- SVG check icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
                <hr class="mb-4">
                <p class="text-blue-400 mb-4 text-center cursor-pointer hover:text-blue-700 ">Login with existing Account </p>
                <button class="absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <!-- SVG cancel icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-4 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="loginInstagram" class="w-96 flex flex-col items-center bg-white rounded-lg shadow-md p-6 relative">
                <!-- <h3>Registeration</h3> -->
                <h2 class="text-2xl font-bold leading-7 mb-5 text-gray-900 sm:text-3xl sm:tracking-tight">Registration</h2>
                <button onclick="openInstagramLoginPage()" class="bg-blue-500 mt-5 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Login With Facebook
                </button>
            </div>
    </div>

<script>

    let isLoggedIn = false;

    const showLoggedInContent = () => {
        if(isLoggedIn) {
            document.getElementById('loggedInContent').style.display = 'block';
            document.getElementById('loginInstagram').style.display = 'none';
        }
        else {
            document.getElementById('loggedInContent').style.display = 'none';
            document.getElementById('loginInstagram').style.display = 'block';
        }
    };

    showLoggedInContent();

    const showAvailablePages = (pages) => {
        const pageEl = document.getElementById('pagesContainer');

    };

    const fetchapi = async (finalData) => {
        fetch('../../backend/api/registerUser.php', {
                method: 'POST',
                body: JSON.stringify(finalData),
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log('data', data); // Log the parsed JSON response from the PHP script
                // window.location.href = `profile.php?userId=${data.id}`;
                isLoggedIn = true;
                showLoggedInContent();
            })
            .catch(error => {
                isLoggedIn = true;
                showLoggedInContent();
                console.error('Error:', error);
            });
    }

    const getInstagramAccountId = async (pageId, pageAccessToken) => {
        let res;
        try {
            res = await new Promise((resolve, reject) => {
                FB.api(
                    `/${pageId}`,
                    'GET', {
                        access_token: pageAccessToken,
                        fields: 'instagram_business_account'
                    },
                    function(response) {
                        if (!response || response.error) {
                            reject(response.error || new Error('Unknown error'));
                        } else {
                            resolve(response);
                        }
                    }
                );
            });
        } catch (error) {
            console.error('Error fetching Instagram account:', error);
        }
        return res["instagram_business_account"].id;
    };

    const getInstagramAccountDetails = async (instaId, pageAccessToken) => {
        let details;
        try {
            details = await new Promise((resolve, reject) => {
                FB.api(
                    `/${instaId}`,
                    'GET', {
                        access_token: pageAccessToken,
                        fields: 'name, username,profile_picture_url, media_count, followers_count, biography, media'
                    },
                    function(response) {
                        if (!response || response.error) {
                            reject(response.error || new Error('Unknown error'));
                        } else {
                            resolve(response);
                        }
                    }
                );
            });
        } catch (error) {
            console.error('Error fetching Instagram account:', error);
        }

        return details;
    }

    const getMediaDetails = async (mediaId, pageAccessToken) => {
        let mediaDetails;
        try {
            mediaDetails = await new Promise((resolve, reject) => {
                FB.api(
                    `/${mediaId}`,
                    'GET', {
                        access_token: pageAccessToken,
                        fields: 'media_type, thumbnail_url, permalink, media_url, like_count, comments_count'
                    },
                    function(response) {
                        if (!response || response.error) {
                            reject(response.error || new Error('Unknown error'));
                        } else {
                            resolve(response);
                        }
                    }
                );
            });
        } catch (error) {
            console.error('Error fetching Instagram account:', error);
        }

        return mediaDetails;
    }

    const openInstagramLoginPage = () => {
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        window.fbAsyncInit = function() {
            FB.init({
                appId: '1737552000101235',
                xfbml: true,
                version: 'v19.0'
            });
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', {
                        fields: 'accounts'
                    }, function(response) {
                        const page = response.accounts["data"][0];
                        const pageId = page.id;
                        const pageAccessToken = page.access_token;
                        getInstagramAccountId(pageId, pageAccessToken).then((instaId) => {
                            getInstagramAccountDetails(instaId, pageAccessToken).then((accountDetails) => {
                                const mediaPromises = accountDetails["media"]["data"].map(media => {
                                    return getMediaDetails(media.id, pageAccessToken)
                                        .then(mediaDetails => ({
                                            id: media.id,
                                            details: mediaDetails
                                        }));
                                });
                                Promise.all(mediaPromises).then(mediaDetailsArray => {
                                    // Sort the media details array based on the original order of IDs
                                    mediaDetailsArray.sort((a, b) => {
                                        return accountDetails["media"]["data"].findIndex(item => item.id === a.id) - accountDetails["media"]["data"].findIndex(item => item.id === b.id);
                                    });
                                    const finalData = {
                                        ...accountDetails,
                                        media: mediaDetailsArray.map(media => media.details)
                                    }
                                    console.log(finalData);
                                    fetchapi(finalData);
                                }).catch(error => {
                                    console.error('Error fetching media details:', error);
                                });
                            })
                        })
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        };
    }
</script>
</body>

</html>