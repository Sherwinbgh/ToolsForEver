<?php
// hier zegt hij dat als de sessie ingelogd is dat hij dan de pagina laat zien en
    session_start();
    require("Connection.php");
    if (isset($_POST['logout-submit'])) {
        session_unset();
        session_destroy();
        header("Location: Inlogpagina.php");
        exit();
    }
// hier zegt hij dat als de sessie niet ingelogd is dat hij dan naar de inlogpagina gaat
    if (isset($_POST['login-submit'])){
        $email      = $_POST['email'];
        $password   = $_POST['password'];
// hier pak ik mijn sql statement en zeg ik dat hij de email en wachtwoord moet pakken van de gebruiker
        $sql = "SELECT * FROM Gebruiker WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(password_verify($password, $row['Wachtwoord']))
                $_SESSION["ingelogd"] = true;
                $_SESSION["Email"] = $row['Email'];
                header("Location: Homepagina.php");
                exit();
            }
// als het niet klopt dat geeft het een foutmelding
        }else{
            echo "Inloggen mislukt";
        }
        $stmt-> close();
    }
// hier zegt hij dat als de sessie ingelogd is dat hij dan de pagina laat zien en
    if (isset($_SESSION["ingelogd"]) && $_SESSION["ingelogd"]) {
        header("Location: Homepagina.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Style/Inlogpagina.css">
    <title>Inloggen</title>
</head>
<body>
    <div class="gegevens">
    <form action="inlogpagina.php" method="post">
            <h1>Inloggen</h1>
            <h2>Email</h2>
            <input type="text" name="email" placeholder="Email">
            <h2>Wachtwoord</h2>
            <input type="password" name="password" placeholder="Password">
            <br>
            <button type="submit" name="login-submit">Inloggen</button>
            <br>
        </form>
        <button type="submit" name="signup-submit" onclick="location.href='Signup.php'">Registreren</button>
        </div>
</body>
</html>