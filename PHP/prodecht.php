<?php

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
    <div class="grid">
        <p><?php echo $row['Product']; ?></p>
        <p><?php echo $row['Type']; ?></p>
        <p><?php echo $row['Fabrieken']; ?></p>
        <p><?php echo $row['Inkoop']; ?></p>
        <p><?php echo $row['Verkoop']; ?></p>
</div>