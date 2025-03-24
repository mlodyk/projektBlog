<?php
$pdo = new PDO("mysql:host=localhost;dbname=projekt", "root", ""); 
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Pobranie ID obrazu z parametru GET

$sql = "SELECT zdjecie FROM posty WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // header("Content-Type: image/jpeg");
    echo $row['zdjecie']; // Wyświetlenie obrazu
} 
else {
    http_response_code(404);
    echo "Obraz nie znaleziony.";
}
?>
