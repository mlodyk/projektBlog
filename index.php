<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


$search = isset($_GET['search']) ? $_GET['search'] : null;
$tag_id = isset($_GET['tag']) ? $_GET['tag'] : null;


$isLoggedIn=$user_id!=0;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projekt";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if($search){
    $sql="SELECT * from posty where posty.tytul LIKE '%$search%'";
}elseif($tag_id){
    $sql="SELECT * from posty where posty.id_tag = $tag_id";
}else{
    $sql="SELECT * from posty";
}

$result = $conn->query($sql);

$tags = $conn->query("SELECT * FROM tagi");

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
        <section class="searchContainer">
            <input class="search" id="searchInput" type="text" 
            
            <?php if($search): ?>
                value="<?php echo $search; ?>"
            <?php endif; ?>
            >
            <section class="searchIconContainer" onclick="search()">
                <img class="searchIcon" src="./ikony/search.svg" >
            </section>
        </section>


        <section class="navButtons">
            <a class="navButton" href="./index.php">przeglądaj</a>
            <a class="navButton" href="./liked.php">polubione</a>
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
        <section class="tags">

        <?php
            while ($row = $tags->fetch_assoc()) {
                echo "<p class='tagButton' id='{$row['id']}' onclick='filter(this.id)'>{$row['nazwa']}</p>";
            }
            echo "</section>";
        if($result->num_rows>0){?>


        <?php
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