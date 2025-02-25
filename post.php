<?php

$servername = "localhost"; // Adres serwera MySQL (np. 127.0.0.1)
$username = "root"; // Użytkownik bazy danych
$password = ""; // Hasło do bazy danych
$dbname = "projekt"; // Nazwa bazy danych

$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Pobranie ID obrazu z parametru GET


// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Zapytanie SQL
$sql = "SELECT tytul, zdjecie, liczbaLike, users.nazwa as nazwa, tagi.nazwa as tag from posty
join users on users.id=posty.id_autor
join tagi on tagi.id=posty.id_tag
where posty.id=$id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$conn->close();



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link rel="stylesheet" href="./style/post.css">
    <script src="app.js"></script>
</head>
<body>
    <header>

    </header>
    <main>
        <section class="nameContainer">
            <?php
                echo "<p>@".$row['nazwa']."</p>";
                echo "<p>".$row['tytul']."</p>";
                echo "<p>".$row['tag']."</p>";
            ?>    
        </section>
        <!-- <img class="mainImg" src="./zdjecia/i1.jpg"> -->
        <?php
        $imageUrl = "image.php?id=" . $id;
        echo "<img class='mainImg' src='$imageUrl'>";


    
        ?>





        <!-- <section class="likeContainer">
            <img class="heart" src="serce.png">
            <p class="likesCount">2451</p>
        </section> -->
    </main>
</body>
</html>