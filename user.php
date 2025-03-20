<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$userPageId = isset($_GET['id']) ? $_GET['id'] : null;
if(!$userPageId){
    die("Nieprawidłowe ID użytkownika.");
}

$ownPage=($user_id==$userPageId);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$isLoggedIn=$user_id!=0;


// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Zapytanie SQL
$sql = "SELECT * FROM posty 
WHERE id_autor = $userPageId;";
$result = $conn->query($sql);

$userSql="SELECT * FROM users WHERE id=$userPageId";
$user = $conn->query($userSql)->fetch_assoc();

// $user = $conn->query($userSql);


$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj</title>
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="app.js"></script>
</head>
<body>
    <nav>

        <section class="navButtons">
            <a class="navButton" href="./index.php">przeglądaj</a>
            <a id="liked" class="navButton" href="./liked.php">polubione</a>
            <a class="navButton" href="./addPost.html">stwórz</a>
            <?php if($ownPage): ?>
                <a class="navButton" href="./wyloguj.php">wyloguj się</a>
            <?php endif; ?>
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
        <h1 id="likedTitle" class="likedTitle"><?php echo $user['nazwa']?></h1>

        <?php
        if($result->num_rows>0){
            echo "<section class='blogButtonContainer'>";
            while ($row = $result->fetch_assoc()) {
                $imageUrl = "image.php?id=" . $row['id'];
                echo "<section class='blogButton' style='background-image: url(\"$imageUrl\");' onclick='redirectToPost($row[id])'>
                    {$row['tytul']}
                </section>";
            }   
            echo "</section>";

        }else{
            echo "
                <section class='noResultsContainer'>
                    <section class='noResults'>
                        <img src='./ikony/sadFace.gif' class='sadFace'>
                        Niestety, nie znaleźliśmy żadnych wyników.
                    </section>
                </section>
                ";
        }
        ?>

    </main>
</body>
</html>