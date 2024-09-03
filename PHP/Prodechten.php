<?php
session_start();
require("Connection.php");


$sql = "select * from Artikel";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/prodechten.css">
    <title>Produchten</title>
</head>
<body>
<header>
<header>
    <nav class="navbar"> 
        <ul>
        <div class="china">
            <h1>您好，您已登錄</h1>
            </div>
            <div class="Home">
            <h1>Produchten</h1>
            </div>
                <li><a href="Homepagina.php">Home</a></li>
                <li><a href="account.php">account</a></li>
                <li><form action="Inlogpagina.php" method="post">
                <button type="submit" name="logout-submit">Logout</button></form></li>
        </ul>
    </nav>
</header>
</header>
    <input type="text" name="search" placeholder="Search..." id="searchbar">
<table>
    <tr>
        <th>Product</th>
        <th>Type</th>
        <th>Fabrieken</th>
        <th>Inkoop</th>
        <th>Verkoop</th>
    </tr>
</table>
<div id="prodechtContineer">
<?php
foreach ($result as $row) {
    include("Prodecht.php");
}
?>
</div>
<script src="../Javascript/searchbar.js"></script>
</body>
</html>