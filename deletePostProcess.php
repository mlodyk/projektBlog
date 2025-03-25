<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

// Pobierz dane JSON z php://input
$jsonData = file_get_contents('php://input');
$dane = json_decode($jsonData, true);

// Pobierz ID posta z danych JSON
$postId = $dane['postId'] ?? null;

// Zabezpiecz ID przed SQL Injection
if ($postId !== null) {
    $postId = $conn->real_escape_string($postId);

    // Wykonaj zapytanie usuwające post
    $zapytanie = "DELETE FROM posty WHERE id = '$postId'";
    $wynik = $conn->query($zapytanie);

    // Obsłuż wynik zapytania
    if ($wynik && $conn->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Post usunięty pomyślnie']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Błąd podczas usuwania posta']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowe ID posta']);
}

// Zamknij połączenie
$conn->close();
?>
