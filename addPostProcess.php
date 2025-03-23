<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$conn = new mysqli("localhost", "root", "", "projekt");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Połączenie nieudane: " . $conn->connect_error]));
}

// Pobranie danych z formularza
$title = $_POST['title'] ?? null;
$tagId = $_POST['tagId'] ?? null;
$autorId = $user_id??null;
$image = null;

// Sprawdzenie poprawności danych
if (!$title || !$tagId) {
    echo json_encode(["status" => "error", "message" => "Brak wymaganych danych"]);
    exit;
}

// Odczytanie pliku obrazu
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $image = file_get_contents($_FILES['image']['tmp_name']);
} else {
    echo json_encode(["status" => "error", "message" => "Błąd odczytu pliku"]);
    exit;
}

// Zapytanie SQL
$sql = "INSERT INTO posty (tytul, zdjecie, liczbaLike, id_autor, id_tag) VALUES (?, ?, 0, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sbii", $title, $null, $autorId, $tagId);
    $stmt->send_long_data(1, $image); // Obsługa BLOB w MySQLi

    if ($stmt->execute()) {
        $postId = $stmt->insert_id; // Pobranie ID dodanego posta
        echo json_encode(["status" => "success", "message" => "Post dodany!", "postId" => $postId]);
    } else {
        echo json_encode(["status" => "error", "message" => "Błąd zapisu: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Błąd przygotowania zapytania: " . $conn->error]);
}

$conn->close();
?>
