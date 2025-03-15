<!DOCTYPE html>
<html>
<head>
    <title>Blacklist Menu</title>
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
        <h2>Blacklist Menu</h2>
        <a href="addBlacklist.php" class="button">Add to Blacklist</a>
        <a href="searchBlacklist.php" class="button">Search Blacklist</a>
        <a href="../index.php" class="button">Home</a>
    </div>
</body>
</html>

