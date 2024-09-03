<?php
session_start();
require_once("Connection.php");
$sql = "SELECT * FROM Gebruiker WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["Email"]);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    $data = [];
}

if(isset($_POST["Update-submit"])){
    $voornaam = $_POST["Voornaam"];
    $email = $_POST["Email"];
    $wachtwoord = $_POST["Wachtwoord"];
    if(isset($voornaam) && isset($email) && !empty($voornaam) && !empty($email)){
        $stmt = $conn->prepare("UPDATE Gebruiker SET Voornaam = ?, Email = ? WHERE Email = ?");
        $stmt->bind_param("sss", $voornaam, $email, $_SESSION["Email"]);
        $stmt->execute();
        $_SESSION["Email"] = $email;
    }
}

if(isset($_POST["Verwijder-submit"])){
    $stmt = $conn->prepare("DELETE FROM Gebruiker WHERE Email = ?");
    $stmt->bind_param("s", $_SESSION["Email"]);
    $stmt->execute();
    session_destroy();
    header("Location: Inlogpagina.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Style/account.css">
    <title>Account</title>
</head>
<body>
    <header>
            <nav class="navbar"> 
                <ul>
                <div class="china">
                <h1>您好，您已登錄</h1>
                </div>
                <div class="Account">
                <h1>Accout</h1>
                </div>
                    <li><a href="Homepagina.php">Home</a></li>
                    <li><a href="account.php">account</a></li>
                    <li><form action="Inlogpagina.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button></form></li>
                </ul>
            </nav>
        </header>
        <div class="grid">
        <div class="sonic">
        <img src="../Fotos/sonic rush pose.png" alt="sonic rush pose" width="200px">
        </div>
    <div class="gegevens">
        <form action="account.php" method="post">
            <h1>U gegevens</h1>
            <h2>Voornaam</h2>
             <input type="text" name="Voornaam" value="<?php echo $data["Voornaam"]?>">
            <h2>Email</h2>
            <input type="text" name="Email" value="<?php echo $data["Email"]?>">
            <h2>Wachtwoord</h2>
            <input type="password" name="Wachtwoord" placeholder="wachtwoord wijzegen">
            <br>
            <button type="submit" name="Update-submit">Update account</button>
            <button type="submit" name="Verwijder-submit">Verwijder account</button>
            <?php 
            if(isset($_POST["Update-submit"])){
                echo  "<br>";
                echo "Account is geupdate";
            }
            ?>
        </form>
        </div>
        </div>
</body>
</html>