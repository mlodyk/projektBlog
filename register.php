<?php
    session_start();    
    $con = mysqli_connect('localhost', 'root', '', 'projekt');
    $nazwa = $_POST['nazwa'];
    $haslo = ($_POST['haslo']);
    $email = $_POST['email'];

    $kwerenda = "INSERT INTO users(nazwa, haslo, email) VALUES ('$nazwa', '$haslo', '$email')";

    if (mysqli_query($con, $kwerenda)) {
        header("Location: afterRegister.html");
        exit();
    } 
    else {
        echo "Błąd: " . mysqli_error($con);
    }
    mysqli_close($con);
?>