<?php
session_start();

// Usuwamy wszystkie dane sesji
session_unset();
session_destroy();

// Przekierowujemy użytkownika na stronę logowania
header("Location: login.php");
exit();
?>