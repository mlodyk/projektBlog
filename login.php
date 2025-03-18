<?php
session_start();

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
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="./style/afterRegister.css">
</head>
<body>   

<?php if ($user_name): ?>
    <section class="con">
            <h1>Witaj, <?php echo $user_name;?>! </h1>
            <p>Jesteś już zalogowany</p>
            <section class="buttons">
                <a  class="loginButton" href="./wyloguj.php">WYLOGUJ</a>
                <a  class="loginButton" onclick="window.history.back();">POWRÓT</a>
            </section>
    </section>
<?php else: ?>

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
        <form action="login_process.php" method="POST">
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
            <button class="button" type="submit">WYŚLIJ</button>
        </form>
    </section>
<?php endif; ?>

</body>
</html>
