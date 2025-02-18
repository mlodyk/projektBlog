<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
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
            <a class="navButton" href="">stwórz</a>
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
        <section class="blogButton" >
            AMG GT63s
        </section>
        <section class="blogButton" >
            Porsche 911
        </section>
        <section class="blogButton">
            PENNE
        </section>
        <section class="blogButton">
            Włochy
        </section>
        <section class="blogButton">
            Madagaskar
        </section>
        <section class="blogButton">
            ROLEX
        </section>
        <section class="blogButton">
            OLA DZIURZYŃSKA
        </section>
        <section class="blogButton">
            spaghetti bolognese
        </section>
        <section class="blogButton">
            Porsche 911
        </section>
        <section class="blogButton">
            tatoo chest
        </section> 
        <section class="blogButton">
            black outfit
        </section>
        <!-- <section class="blogButton">
            <p class="blogTitle">czarny outfit y2k</p>

        </section> -->
    </main>
</body>
</html>