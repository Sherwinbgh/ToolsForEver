<?php
    if (isset($_SESSION["ingelogd"])){
        if ($_SESSION["ingelogd"] == true){
            
    }else{
        header("Location: Inlogpagina.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Homepagina.css">
    <title>Home</title>
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
            <h1>Home</h1>
        </nav>
    </header>
    <div class="gegevens">
        <p>Welkom op de homepagina, wat wilt u doen?</p>
        <button onclick="location.href='produchten.php'" name="producten">Producten</button>
</body>
</html>