<?php
session_start();
session_unset();
session_destroy();

header("Location: afterLogout.html");
// header("Location: ".$_SESSION['lastPage']);

exit();
?>
