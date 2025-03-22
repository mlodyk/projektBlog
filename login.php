<?php
session_start();

// $lastPage=$_SERVER['HTTP_REFERER'];

// $lastPage = isset($_GET['lastPage'])?$_GET['lastPage']:null;

$actualPage = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$lastPage=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'index.php';


if($actualPage!=$lastPage && $lastPage!='http://localhost/projekt/afterLogout.html' && $lastPage!='http://localhost/projekt/afterRegister.html'){
    $_SESSION['lastPage'] = $lastPage;
}elseif($lastPage=='http://localhost/projekt/afterLogout.html'){
    $_SESSION['lastPage'] = 'index.php';
}




$nazwa = isset($_POST['nazwa'])?$_POST['nazwa']:null;
$haslo = isset($_POST['haslo'])?$_POST['haslo']:null;



if($nazwa && $haslo){
    $conn = mysqli_connect('localhost', 'root', '', 'projekt');


    $kwerenda = "SELECT * FROM users WHERE nazwa='$nazwa' AND haslo='$haslo'";
    $wynik = mysqli_query($conn, $kwerenda);

    if (mysqli_num_rows($wynik) > 0) {
        $row = mysqli_fetch_assoc($wynik);

        if ($haslo == $row['haslo']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nazwa'];

            header("Location: ".$_SESSION['lastPage']);
            exit();

            echo "
            <script type=\"text/javascript\">
            
            </script>
            ";
            // header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Niepoprawne hasło.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Nie ma takiego użytkownika.";
        header("Location: login.php");
        exit();
    }
}




if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
} else {
    $user_name = null; 
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- <link rel="stylesheet" href="./style/login.css"> -->
    <!-- <link rel="stylesheet" href="./style/afterRegister.css"> -->
</head>
<body>   

<?php if ($user_name): ?>
    <link rel="stylesheet" href="./style/afterRegister.css">

    <section class="con">
            <h1 class="title">Witaj, <?php echo $user_name;?>! 
                <p>Jesteś już zalogowany</p>
            </h1>
            
            <section class="buttons">
                <a  class="button" href="./wyloguj.php">WYLOGUJ</a>
                <a  class="button" onclick="window.history.back();">POWRÓT</a>
            </section>
    </section>
<?php else: ?>
    <link rel="stylesheet" href="./style/login.css">

    <a class="homeContainer"  href="./index.php">
            <img id="home" src="./ikony/home.svg">
            <p class="homeText">HOME</p>
    </a>

    <section class="signUp">
        <p class="title">REJESTRACJA</p>
        <form action="register.php" method="POST">
            <section class="inputContainer">
                <section>
                    <input type="text" name="nazwa" id="nazwa" required>
                    <label for="nazwa">nazwa</label>
                </section>
                <section>
                    <input type="password" name="haslo" id="haslo" required>
                    <label for="haslo">hasło</label>
                </section>
                <section>
                    <input type="email" name="email" id="email" required>
                    <label for="email">email</label>
                </section>
            </section>
            <button class="button" type="submit">WYŚLIJ</button> 
        </form>
    </section>

    <section class="logIn">
        <p class="title">LOGOWANIE</p>
        <form action="login.php" method="POST">
            <section class="inputContainer">
                <section>
                    <input type="text" name="nazwa" required>
                    <label for="nazwa">nazwa</label>
                </section>
                <section>
                    <input type="password" name="haslo" required>
                    <label for="haslo">hasło</label>
                </section>
            </section>
            <button class="button" type="submit" value="test">WYŚLIJ</button>
        </form>
    </section>
<?php endif; ?>

</body>
</html>
