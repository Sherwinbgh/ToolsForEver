<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Style/toe-del.css">
    <title>Toevoegen en deleten</title>
</head>
<body>
<header>
            <nav class="navbar"> 
                <ul>
                <div class="china">
                <h1>您好，您已登錄</h1>
                </div>
                <div class="Home">
                <h1>Toevoegen en Verwijderen</h1>
                </div>
                    <li><a href="Homepagina.php">Home</a></li>
                    <li><a href="account.php">account</a></li>
                    <li><form action="Inlogpagina.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button></form></li>
                </ul>
            </nav>
        </header>
    <div class="icons">
    <table>
        <tr>
            <th>Product</th>
            <th>Prijs</th>
            <th>Toevoegen</th>
            <th>Verwijderen</th>
        </tr>
    </table>
    </div>
</body>
</html>