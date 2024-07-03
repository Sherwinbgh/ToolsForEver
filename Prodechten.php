<?php
session_start();
require("Connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prodechten.css">
    <title>Produchten</title>
</head>
<body>
<header>
        <nav>
            <ul>
            <h1>您好，您已登錄</h1>
                <li><a href="Homepagina.php">Home</a></li>
                <li><a href="account.php">account</a></li>
                <li><form action="Inlogpagina.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </ul>
            <h1>Prodechten</h1>
        </nav>
    </header>
<form action="search.php" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
</form>
</body>
</html>