<?php
session_start();

// Sprawdzamy, czy użytkownik jest zalogowany
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
} else {
    $user_name = null;  // Jeśli użytkownik nie jest zalogowany
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./style/login.css">
</head>
<body>   

<?php if ($user_name): ?>
    <section class="logIn">
        <p class="title">Witaj, <?php echo htmlspecialchars($user_name); ?>!</p>
        <a href="wyloguj.php" class="button2">Wyloguj się</a>
    </section>
<?php else: ?>
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
