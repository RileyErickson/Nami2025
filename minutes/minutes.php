<!DOCTYPE html>
<html>
<head>
    <title>Minutes Management</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #add8e6;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .button {
            display: block;
            background-color: #808080;
            color: white;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .button:hover {
            background-color: #696969;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Minutes Management</h2>
        <a href="addMinutes.php" class="button">Add Minutes</a>
        <a href="editMinutes.php" class="button">Edit Minutes</a>
        <a href="searchMinutes.php" class="button">Search Minutes</a>
	<a href="../index.php" class="button">Go back to dashboard</a>
    </div>
</body>
</html>

