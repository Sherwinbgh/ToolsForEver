<?php
// hier zegt hij dat als de sessie ingelogd is dat hij dan de pagina laat zien en
// als de sessie niet ingelogd is dat hij dan naar de inlogpagina gaat
session_start();
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
    <link rel="stylesheet" type="text/css" href="../Style/Homepagina.css">
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
        <button type="button" onclick="window.location.href='prodechten.php'">Prodechten</button>
        <button type="button" onclick="window.location.href='toe-del.php'">Toevoegen en deleten</button>
</body>
</html>