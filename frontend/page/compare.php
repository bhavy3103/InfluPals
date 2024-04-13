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
            width: calc(48% - 5px); /* Adjusted width to accommodate margin */
            height: 30px;
            padding: 2px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            margin-right: 5px; /* Adjusted margin for spacing */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed; /* Fixed layout to prevent content from expanding the table */
            overflow-x: auto; /* Enable horizontal scrolling if content exceeds table width */
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap; /* Prevent text wrapping */
        }
        th {
            background-color: #3498db;
            color: #fff;
        }
        .influencer1 {
            background-color: #d5dbdb;
        }
        .influencer2 {
            background-color: #f2dede;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">

<div style="max-width: 1200px; margin: 0 auto; padding: 20px; overflow-x: auto;">
    <div class="button-container">
        <input type="text" id="influencer1Input" placeholder="Search for Influencer 1" onkeyup="fetchSuggestions(this.value, 'influencer1')">
        <input type="text" id="influencer2Input" placeholder="Search for Influencer 2" onkeyup="fetchSuggestions(this.value, 'influencer2')">
        <button onclick="compareInfluencers()">Compare</button>
    </div>
    
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
            console.log("add",allUsers);
        })
        .catch(error => console.error('Error fetching all users:', error));

    // Step 2: Function to fetch suggestions
    function fetchSuggestions(input, influencer) {
        const filteredUsers = allUsers.filter(user => user.username.toLowerCase().includes(input.toLowerCase()));
        // Display suggestions for the influencer
        // You can implement this based on your UI design
    }

    // Step 3: Function to compare influencers
    function compareInfluencers() {
        const influencer1Name = document.getElementById('influencer1Input').value.trim();
        const influencer2Name = document.getElementById('influencer2Input').value.trim();

        const influencer1 = allUsers.find(user => user.username.toLowerCase() === influencer1Name.toLowerCase());
        const influencer2 = allUsers.find(user => user.username.toLowerCase() === influencer2Name.toLowerCase());

        if (!influencer1 || !influencer2) {
            alert('Please select valid influencers.');
            return;
        }

        // Step 4: Fetch data for both influencers
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
            populateComparisonTable(data, influencerClass);
        })
        .catch(error => console.error('Error fetching influencer data:', error));
    }

    // Step 5: Function to populate comparison table
    function populateComparisonTable(data, influencerClass) {
        const table = document.querySelector('table');
        const rows = table.querySelectorAll('tr');

        const criteria = Object.keys(data);
        criteria.forEach(criterion => {
            const row = document.createElement('tr');
            const cell1 = document.createElement('td');
            const cell2 = document.createElement('td');
            const cell3 = document.createElement('td');

            cell1.textContent = criterion;
            cell2.textContent = data[criterion];
            cell3.textContent = data[criterion];

            row.appendChild(cell1);
            row.appendChild(cell2);
            row.appendChild(cell3);

            // Add class to differentiate influencer columns
            cell2.classList.add(influencerClass);
            cell3.classList.add(influencerClass);

            table.appendChild(row);
        });
    }
</script>

</body>
</html>
