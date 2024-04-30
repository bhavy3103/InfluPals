<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Dialog</title>
    <style>
        /* Styles for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<button onclick="openDialog()">Open Custom Dialog</button>

<div id="customDialog" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDialog()">&times;</span>
        <h2>Custom Dialog</h2>
        <p>This is a custom dialog box. You can customize it with your content and styles.</p>
        <button onclick="closeDialog()">Close</button>
    </div>
</div>

<script>
    // Function to open the custom dialog
    function openDialog() {
        document.getElementById('customDialog').style.display = 'block';
    }

    // Function to close the custom dialog
    function closeDialog() {
        document.getElementById('customDialog').style.display = 'none';
    }
</script>

</body>
</html>
