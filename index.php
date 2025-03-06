<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;





$isLoggedIn=$user_id!=0;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

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
    <link rel="stylesheet" href="./style/nav.css">
    <script src="app.js"></script>
</head>
<body>
    <nav>
        <section class="navButtons">
            <a class="navButton" href="./index.php">przeglądaj</a>
            <a class="navButton" href="./liked.php">polubione</a>
            <a class="navButton" href="./addPost.html">stwórz</a>
        </section>

        <a class="loginContainer"  href="<?php if($isLoggedIn==1){echo "./user.php?id=".$user_id;}else{echo "./login.php";} ?>">
            <img id="login" src="login.svg">
            
            <?php if ($user_name): ?>
                <p class="loginText"><?php echo $user_name; ?></p>
            <?php else: ?>
                <p class="loginText">LOGIN</p>
            <?php endif; ?>
        </a>
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




        <!-- <section class="loginContainer" onclick="redirectToLogin()">
            <img id="login" src="login.svg">
            <?php if ($user_name): ?>
                <p class="loginText"><?php echo htmlspecialchars($user_name); ?></p>
            <?php else: ?>
                <p class="loginText">LOGIN</p>
            <?php endif; ?>
        </section> -->