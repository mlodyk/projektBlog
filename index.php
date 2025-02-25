<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;


$servername = "localhost"; // Adres serwera MySQL (np. 127.0.0.1)
$username = "root"; // Użytkownik bazy danych
$password = ""; // Hasło do bazy danych
$dbname = "projekt"; // Nazwa bazy danych

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Zapytanie SQL
$sql = "SELECT * FROM posty"; // Dostosuj do swojej tabeli
$result = $conn->query($sql);
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link rel="stylesheet" href="./style/main.css">
    <script src="app.js"></script>
</head>
<body>
    <nav>
        <!-- <section class="search">
            <input type="text" placeholder="Wyszukaj...">
        </section> -->
        <!-- <section class="logoContainer">
            <img src="./style/logo.png" id="logo">
        </section> -->
        <section class="navButtons">
            <a class="navButton" href="">przeglądaj</a>
            <a class="navButton" href="">polubione</a>
            <a class="navButton" href="./addPost.html">stwórz</a>
        </section>
        <section class="loginContainer" onclick="redirectToLogin()">
            <img id="login" src="login.svg">
            <?php if ($user_name): ?>
                <p class="loginText"><?php echo htmlspecialchars($user_name); ?></p>
            <?php else: ?>
                <p class="loginText">LOGIN</p>
            <?php endif; ?>
        </section>
    </nav>
    <main>
        <?php
        while ($row = $result->fetch_assoc()) {
                $imageUrl = "image.php?id=" . $row['id'];
                echo "<section class='blogButton' style='background-image: url(\"$imageUrl\");' onclick='redirectToPost($row[id])'>
                    {$row['tytul']}
                </section>";
        }   
        ?>
    </main>
</body>
</html>