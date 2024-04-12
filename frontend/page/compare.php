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
    </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">

<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div class="button-container">
        <input type="text" id="influencer1" placeholder="Search for Influencer 1" onkeyup="fetchSuggestions(this.value)">
        <input type="text" id="influencer2" placeholder="Search for Influencer 2" onkeyup="fetchSuggestions(this.value)">
        <button onclick="compareInfluencers(influencer1, influencer2)">Compare</button>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <tr>
            <th style="border: 1px solid #dddddd; background-color: #3498db; color: #fff; text-align: left; padding: 8px;">Comparison Criteria</th>
            <th style="border: 1px solid #dddddd; background-color: #e74c3c; color: #fff; text-align: left; padding: 8px;">Influencer 1</th>
            <th style="border: 1px solid #dddddd; background-color: #f1c40f; color: #fff; text-align: left; padding: 8px;">Influencer 2</th>
        </tr>

        <?php
        // Dummy data for influencers
        $influencer1 = array(
            "Followers" => "100,000",
            "Likes Count" => "10,000",
            "Impressions Count" => "500,000",
            "Average Likes on Post" => "100",
            "Average Engagements on Post" => "150"
        );

        $influencer2 = array(
            "Followers" => "200,000",
            "Likes Count" => "15,000",
            "Impressions Count" => "750,000",
            "Average Likes on Post" => "120",
            "Average Engagements on Post" => "180"
        );

        foreach ($influencer1 as $criteria => $value1): ?>
            <tr>
                <td style="border: 1px solid #dddddd; background-color: #ecb0f1; text-align: left; padding: 8px;"><?php echo $criteria; ?></td>
                <td style="border: 1px solid #dddddd; background-color: #d5dbdb; text-align: left; padding: 8px;"><?php echo $value1; ?></td>
                <td style="border: 1px solid #dddddd; background-color: #f2dede; text-align: left; padding: 8px;"><?php echo $influencer2[$criteria]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

</body>
</html>
