<?php
session_start();
if (!(isset($_SESSION['id']) && (strtolower($_SESSION['role']) === 'admin' || strtolower($_SESSION['role']) === 'user')))
    header("Location: login.php");
else
    header("Location: compare.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencer Comparison</title>
    <style>
        /* Style for buttons */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .button-container input[type="text"],
        .button-container button {
            width: calc(48% - 5px);
            /* Adjusted width to accommodate margin */
            height: 30px;
            padding: 2px;
            box-sizing: border-box;
            /* Include padding and border in element's total width and height */
            margin-right: 5px;
            /* Adjusted margin for spacing */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
            /* Fixed layout to prevent content from expanding the table */
            overflow-x: auto;
            /* Enable horizontal scrolling if content exceeds table width */
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        th {
            background-color: #0885B0;
            color: #fff;
        }

        .influencer1 {
            background-color: #338AFF;
        }

        .influencer2 {
            background-color: #084FB0;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">

    <div style="max-width: 1200px; margin: 0 auto; padding: 20px; overflow-x: auto;">

        <table>
            <tr>
                <th>Comparison Criteria</th>
                <th class="influencer1">Influencer 1</th>
                <th class="influencer2">Influencer 2</th>
            </tr>
            <!-- Table rows will be added dynamically -->
        </table>

    </div>

    <script>
        let allUsers = [];

        // Step 1: Fetch all users
        fetch('../../backend/api/getAllUsers.php')
            .then(response => response.json())
            .then(data => {
                allUsers = data;
                // Extract influencer IDs from URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const userId1 = urlParams.get('userId1');
                const userId2 = urlParams.get('userId2');

                // Find influencer objects based on IDs
                const influencer1 = allUsers.find(user => user.id === userId1);
                const influencer2 = allUsers.find(user => user.id === userId2);

                // Compare influencers if both are found
                if (influencer1 && influencer2) {
                    compareInfluencers(influencer1, influencer2);
                } else {
                    console.error('Invalid influencer IDs.');
                }
            })
            .catch(error => console.error('Error fetching all users:', error));

        // Add a global variable to track the number of times the populateComparisonTable function is called
        let comparisonTablePopulated = false;

        // Step 2: Function to compare influencers
        function compareInfluencers(influencer1, influencer2) {
            // Fetch data for both influencers
            fetchInfluencerData(influencer1, 'influencer1');
            fetchInfluencerData(influencer2, 'influencer2');
        }

        // Function to fetch influencer data
        function fetchInfluencerData(influencer, influencerClass) {
            fetch('../../backend/api/getSingleUser.php', {
                method: 'POST',
                body: JSON.stringify({ id: influencer.id }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Populate comparison table only when data for both influencers is available
                    if (influencerClass === 'influencer1') {
                        influencer1Data = data;
                    } else if (influencerClass === 'influencer2') {
                        influencer2Data = data;
                    }

                    if (influencer1Data && influencer2Data && !comparisonTablePopulated) {
                        populateComparisonTable(influencer1Data, influencer2Data);
                        comparisonTablePopulated = true;
                    }
                })
                .catch(error => console.error('Error fetching influencer data:', error));
        }

        // Function to populate comparison table
        function populateComparisonTable(influencer1Data, influencer2Data) {
            const table = document.querySelector('table');

            // Function to create a row for each criterion and populate data
            const createRow = (criterion, influencer1Data, influencer2Data) => {
                const row = document.createElement('tr');
                const cell1 = document.createElement('td');
                const cell2 = document.createElement('td');
                const cell3 = document.createElement('td');
                cell1.textContent = criterion;

                // Check if the criterion is demographics or some other data
                if (criterion === 'demographicsAge' || criterion === 'demographicsGender') {
                    // If it's demographics, cityData, or genderData, format the data
                    const influencer1Text = formatDemographics(influencer1Data[criterion]);
                    const influencer2Text = formatDemographics(influencer2Data[criterion]);
                    cell2.innerHTML = influencer1Text;
                    cell3.innerHTML = influencer2Text;
                }
                else if (criterion === 'demographicsCity') {
                    const influencer1Text = formatDemographicsCity(influencer1Data[criterion]);
                    const influencer2Text = formatDemographicsCity(influencer2Data[criterion]);
                    cell2.innerHTML = influencer1Text;
                    cell3.innerHTML = influencer2Text;
                }
                else if (criterion === 'pricing') {
                    Object.keys(influencer1Data[criterion]).forEach((val) => {

                        if (val === 'page_id' || val === 'id') {
                            return;
                        }

                        // Create a new row for each key-value pair
                        const newRow = document.createElement('tr');

                        // Create cells for key, influencer1 value, and influencer2 value
                        const keyCell = document.createElement('td');
                        const influencer1Cell = document.createElement('td');
                        const influencer2Cell = document.createElement('td');

                        // Set the content of cells
                        keyCell.textContent = val;
                        influencer1Cell.textContent = influencer1Data.pricing[val];
                        influencer2Cell.textContent = influencer2Data.pricing[val];

                        // Append cells to the new row
                        newRow.appendChild(keyCell);
                        newRow.appendChild(influencer1Cell);
                        newRow.appendChild(influencer2Cell);

                        // Append the new row to the table
                        if (keyCell != 'page_id')
                            table.appendChild(newRow);
                    });
                    return;
                }
                else {
                    // If it's not demographics, cityData, or genderData, simply display the data
                    console.log(criterion);
                    const influencer1Text = formatText(influencer1Data[criterion]);
                    const influencer2Text = formatText(influencer2Data[criterion]);
                    cell2.innerHTML = influencer1Text;
                    cell3.innerHTML = influencer2Text;
                }
                row.appendChild(cell1);
                row.appendChild(cell2);
                row.appendChild(cell3);
                table.appendChild(row);
            };


            // Function to format text and add line breaks if it exceeds a certain length
            const formatText = (text) => {
                const maxLength = 40; // Maximum characters before line break
                let formattedText = '';
                for (let i = 0; i < text.length; i++) {
                    formattedText += text[i];
                    if ((i + 1) % maxLength === 0 && i !== 0) {
                        formattedText += '<br>';
                    }
                }
                return formattedText;
            };

            // Function to format demographics data
            const formatDemographics = (data) => {
                // Check if data is an array
                if (Array.isArray(data)) {
                    // Iterate over the array and format each object
                    const formattedData = data?.map(item => {
                        // Extract the necessary information from each object
                        return `${item.dimension_values[0]}: ${item.value}`;
                    });
                    // Join the formatted data with line breaks
                    return formattedData.join('<br>');
                }
                return ''; // Return an empty string if data is not an array
            };

            // Function to format demographics data
            const formatDemographicsCity = (data) => {
                // Check if data is an array
                if (Array.isArray(data)) {
                    // Sort city data by value in descending order
                    const sortedCityData = data.sort((a, b) => b.value - a.value);
                    // Take top 5 cities
                    const topCities = sortedCityData.slice(0, 5);
                    // Create an array of strings for top cities and their values
                    const formattedData = topCities.map(city => `${city.dimension_values[0]}: ${city.value}`);
                    // Join the formatted data with line breaks
                    return formattedData.join('<br>');
                }
                return ''; // Return an empty string if data is not an array
            };
            // Loop through each criterion and create rows for each influencer
            Object.keys(influencer1Data).forEach(criterion => {
                // Skip the 'id', 'profile_picture_url', 'biography', and 'media' criteria
                if (criterion !== 'id' && criterion !== 'profile_picture_url' && criterion !== 'biography' && criterion !== 'media') {
                    createRow(criterion, influencer1Data, influencer2Data);
                }
            });


        }
    </script>

</body>

</html>