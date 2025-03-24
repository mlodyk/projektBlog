<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// $isLoggedIn=$user_id??null;
$isLoggedIn=$user_id!=null;


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$conn = new mysqli($servername, $username, $password, $dbname);


$tags = $conn->query("SELECT * FROM tagi");

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DODAJ POST</title>
    <link rel="stylesheet" href="./style/addPost.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="addPost.js"></script>
    <script></script>
</head>
<body>
    <nav>
        <section class="navButtons">
            <a class="navButton" href="./index.php">przeglądaj</a>
            <a id="liked" class="navButton" href="./liked.php">polubione</a>
            <a class="navButton" href="./addPost.php">stwórz</a>
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
        <?php if ($isLoggedIn): ?>

        <section id="addedModal" class="addedModal" onclick="closeModal(this)">
            <section class="addedModalContent" onclick="event.stopPropagation()">
                <p class="addedModalText">Dodano Post!</p>
                <!-- <a href="./login.php?lastPage=true" class="loginModalButton">LOGOWANIE</a> -->
                <a id="zobaczButton" class="addedModalButton">ZOBACZ</a>

            </section>
        </section>  

        <section class="inputContainer">
            <h1 class="titleText">TYTUŁ</h1>
            <input id="titleInput" class="titleInput" type="text" placeholder="(Maksymalnie 20 liter)">
        </section>

        <section class="inputContainer">
            <h1 class="titleText">ZDJĘCIE</h1>
            <input id="imageInput" class="imageInput" type="file">
        </section>

        <section class="inputContainer">
            <h1 class="titleText">WYBIERZ TAG</h1>
            <section class="tags">
            <?php
                while ($row = $tags->fetch_assoc()) {
                    echo "<p class='tagButton' id='{$row['id']}' onclick='chooseTag(this)'>{$row['nazwa']}</p>";
                }
            ?>
            </section>
        </section>

        <button id="submitButton" class="submitButton" type="button" onclick="addPost()">DODAJ</button> 

        <?php else: ?>
            <section class="loginMainContainer">
                <section class="loginMainContent">
                    <p class="loginMainText">Musisz się zalogować, aby dodać post</p>
                    <a href="./login.php" class="loginMainButton">LOGOWANIE</a>
                </section>
            </section>

        <?php endif; ?>
    </main>
</body>
</html>