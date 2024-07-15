<?php
    require("Connection.php");
    if(isset($_POST['signup-submit'])){
        $voornaam       = $_POST['Voornaam']; 
        $achternaam     = $_POST['Achternaam']; 
        $email          = $_POST['Email'];
        $password       = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        if (isset($voornaam)&& isset($achternaam)&& isset($email)&& isset($password)&& 
        !empty($voornaam)&& !empty($achternaam)&& !empty($email)&& !empty($password)){
            echo "is gelukt"; 
            $stmt = $conn-> prepare("INSERT INTO Gebruiker (Voornaam, Achternaam, Email, Wachtwoord) VALUES (?,?,?,?)");  
            $stmt->bind_param("ssss", $voornaam, $achternaam, $email, $password);
            $stmt->execute();
        }else{
            echo "Vul alle velden goed in";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Style/Signup.css">
    <title>Sign up</title>
</head>
<body>
    <div class="gegevens">
        <form action="Signup.php" method="post">
        <h1>Sign up</h1>
            <h2>Voornaam</h2>
            <input type="text" name="Voornaam" placeholder="Voornaam" required>
            <h2>Achternaam</h2>
            <input type="text" name="Achternaam" placeholder="Achternaam" required>
            <h2>Email</h2>
            <input type="email" name="Email" placeholder="Email" required>
            <h2>Wachtwoord</h2>
            <input type="password" name="Password" placeholder="Password" required>
            <br>
            <button type="submit" name="signup-submit">Sign up</button> 
        </form>
        <button onclick="location.href='inlogpagina.php'" name="signup-submit">Naar Inlog</button>
    </div>
</body>
</html>