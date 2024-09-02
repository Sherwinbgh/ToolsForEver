<?php
session_start();
require("Connection.php");

    header('Content-Type: application/json');
    
    $input = json_decode(file_get_contents('php://input'), true);
    $search = $input['search'] ?? '';
    $sql = "select * from Artikel where Product like '%$search%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
?>