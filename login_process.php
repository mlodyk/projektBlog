<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'projekt');

$nazwa = $_POST['nazwa'];
$haslo = $_POST['haslo'];

$kwerenda = "SELECT * FROM users WHERE nazwa='$nazwa' AND haslo='$haslo'";

$wynik = mysqli_query($conn, $kwerenda);

if (mysqli_num_rows($wynik) > 0) {
    $row = mysqli_fetch_assoc($wynik);

    if ($haslo == $row['haslo']) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['nazwa'];

        header("Location: index.html");
        exit();
    } else {
        $_SESSION['error'] = "Niepoprawne hasło.";
        header("Location: login.html");
        exit();
    }
} else {
    $_SESSION['error'] = "Nie ma takiego użytkownika.";
    header("Location: login.html");
    exit();
}

mysqli_close($conn);
?>
