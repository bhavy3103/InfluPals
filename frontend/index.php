<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="wrapper">

        <form>
            <div class="input">
                <input placeholder="enter your username here...">
            </div>

            <div class="button">
                <button class="btn">Log in</button>
            </div>

        </form>

        <div class="OR-container">
            <span></span>
            <div class="or">OR</div>
            <span></span>
        </div>

        <div class="login-with-instagram">
            <div class="img-link">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e7/Instagram_logo_2016.svg" height="20"
                    width="20" alt="Instagram Icon">
                <a onclick="openInstagramLoginPage()">Login with Instagram</a>
            </div>

        </div>

    </div>

    <script>

        const fetchapi = async (finalData) => {
            fetch('../backend/api/registerUser.php', {
                method: 'POST',
                body: JSON.stringify(finalData),
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log('data', data); // Log the parsed JSON response from the PHP script
            })
            .catch(error => {
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
                        function (response) {
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
                        fields: 'name, username, media_count, followers_count, biography, media'
                    },
                        function (response) {
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
                        function (response) {
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
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            window.fbAsyncInit = function () {
                FB.init({
                    appId: '1737552000101235',
                    xfbml: true,
                    version: 'v19.0'
                });
                FB.login(function (response) {
                    if (response.authResponse) {
                        console.log('Welcome!  Fetching your information.... ');
                        FB.api('/me', {
                            fields: 'accounts'
                        }, function (response) {
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
                                        // location.assign('./page/home.php')
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