<?php
session_start();
require("Connection.php");

$sql = "SELECT Artikel.*, voorraad.*, Locatie.Locatie AS LocatieNaam 
        FROM Artikel 
        INNER JOIN voorraad ON Artikel.idArtikel = voorraad.Artikel_idArtikel 
        INNER JOIN Locatie ON voorraad.Locatie_idLocatie = Locatie.idLocatie";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// foreach ($result as $row) {
//     echo json_encode($row);
//     echo "<br>";
// }
// exit;

if(isset($_POST["update"])){
    $idArtikel = $_POST["idArtikel"];
    $product = $_POST["Product"];
    $type = $_POST["Type"];
    $fabrieken = $_POST["Fabrieken"];
    $m_aantal = $_POST["M-Aantal"];
    $stmt = $conn->prepare("UPDATE Artikel SET Product = ?, `Type` = ?, Fabrieken = ?, `M-Aantal` = ? WHERE idArtikel = ?");
    $stmt->bind_param("ssssi", $product, $type, $fabrieken, $m_aantal, $idArtikel);
    $stmt->execute();
    header("Location: toe-del.php");
}
if(isset($_POST["update2"])){
    $idArtikel = $_POST["idArtikel"];
    $locatie = $_POST["Locatie"];
    $stmt = $conn->prepare("UPDATE Locatie SET Locatie = ? WHERE idLocatie = ?");
    $stmt->bind_param("si", $locatie, $idArtikel);
    $stmt->execute();
    header("Location: toe-del.php");
}

if(isset($_POST["delete"])){
    $idArtikel = $_POST["idArtikel"];
    
    // Verwijder gerelateerde rijen in Artikel_has_Bestelling
    $stmt = $conn->prepare("DELETE FROM Artikel_has_Bestelling WHERE Artikel_idArtikel = ?");
    $stmt->bind_param("i", $idArtikel);
    $stmt->execute();
    
    // Verwijder gerelateerde rijen in voorraad
    $stmt = $conn->prepare("DELETE FROM voorraad WHERE Artikel_idArtikel = ?");
    $stmt->bind_param("i", $idArtikel);
    $stmt->execute();
    
    // Verwijder de rij in Artikel
    $stmt = $conn->prepare("DELETE FROM Artikel WHERE idArtikel = ?");
    $stmt->bind_param("i", $idArtikel);
    $stmt->execute();
    
    header("Location: toe-del.php");
}

if(isset($_POST["create"])){
    $product = $_POST["Product"];
    $type = $_POST["Type"];
    $fabrieken = $_POST["Fabrieken"];
    $inkoop = $_POST["Inkoop"];
    $verkoop = $_POST["Verkoop"];
    $m_aantal = $_POST["M-Aantal"];
    $stmt = $conn->prepare("INSERT INTO Artikel (Product, `Type`, Fabrieken, Inkoop, Verkoop, `M-Aantal`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $product, $type, $fabrieken, $inkoop, $verkoop, $m_aantal);
    $stmt->execute();
    header("Location: toe-del.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Style/toe-del.css">
    <link rel="stylesheet" href="../Style/prodechten.css">
    <title>Toevoegen en Verwijderen</title>
    <link rel="icon" type="image/png" href="Fotos/Logo.png">
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
        <th>Type</th>
        <th>Fabrieken</th>
        <th>Inkoop</th>
        <th>Verkoop</th>
        <th>Aantal</th>
        <th>Locatie</th>
        <th>Verwijderen</th>
        <th>Akkoord</th>
        </tr>
    
    <div id="prodechtContineer">
    <?php
    foreach ($result as $row) {
        

        $input = json_decode(file_get_contents('php://input'), true); 
        
        if ($input) {
            $row = $input['prodecht'] ?? '';
            $response = [
                'Product' => $row['Product'],
                'Type' => $row['Type'],
                'Fabrieken' => $row['Fabrieken'],
                'Inkoop' => $row['Inkoop'],
                'Verkoop' => $row['Verkoop']
            ];
        }
        ?>
        <form action="toe-del.php" method="post">
        <input type="hidden" name="idArtikel" value="<?php echo $row['idArtikel']; ?>">
        <tr>
                <td><input type="text" name="Product" value="<?php echo $row['Product']; ?>"></td>
                <td><input type="text" name="Type" value="<?php echo $row['Type']; ?>"></td>
                <td><input type="text" name="Fabrieken" value="<?php echo $row['Fabrieken']; ?>"></td>
                <td><input type="text" name="Inkoop" value="<?php echo $row['Inkoop']; ?>" disabled></td>
                <td><input type="text" name="Verkoop" value="<?php echo $row['Verkoop']; ?>" disabled></td>
                <td><input type="text" name="M-Aantal" value="<?php echo $row['M-Aantal']; ?>"></td>
                <td><input type="text" name="Locatie" value="<?php echo $row['LocatieNaam']; ?>"></td>
                <td><button name="delete">Verwijderen</button></td>
                <td><button name="update">Akkoord</button></td>
                </tr>
        </form>
        <?php
}
?>
        <form action="toe-del.php" method="post">
        <tr>
                <td><input type="text" name="Product"></td>
                <td><input type="text" name="Type"></td>
                <td><input type="text" name="Fabrieken"></td>
                <td><input type="text" name="Inkoop"></td>
                <td><input type="text" name="Verkoop"></td>
                <td><input type="text" name="M-Aantal"></td>
                <td><input type="text" name="Locatie"></td>
                <td><button name="create">Maken</button></td>
                </tr>
        </form>
    </div>
    </div>
</body>
</html>