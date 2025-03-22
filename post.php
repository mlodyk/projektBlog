<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "projekt"; 

$conn = new mysqli($servername, $username, $password, $dbname);


$isLikedSql="SELECT * from polubienia where id_post=$id and id_user=$user_id;";
$isLikedResult = $conn->query($isLikedSql);


$isLiked=$isLikedResult->num_rows > 0;
$isLoggedIn=$user_id!=0;


if ($id <= 0) {
    die("Nieprawidłowe ID posta.");
}

function addLike($conn, $id, $user_id) {
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }
    $addLikesql = "UPDATE posty SET liczbaLike = liczbaLike + 1 WHERE id = $id";
    $addRelationsql = "INSERT INTO `polubienia` (`id_post`, `id_user`) VALUES ($id, $user_id);";
    if ($conn->query($addLikesql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $addLikesql . "<br>" . $conn->error;
      }

      if ($conn->query($addRelationsql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $addRelationsql . "<br>" . $conn->error;
      }
}

function removeLike($conn, $id, $user_id) {
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }
    $addLikesql = "UPDATE posty SET liczbaLike = liczbaLike - 1 WHERE id = $id";
    $addRelationsql = "DELETE FROM `polubienia` WHERE `id_post`=$id and `id_user`=$user_id;";
    if ($conn->query($addLikesql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $addLikesql . "<br>" . $conn->error;
      }

      if ($conn->query($addRelationsql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $addRelationsql . "<br>" . $conn->error;
      }
}

if (isset($_GET['like']) && $_GET['like'] == 1 && !$isLiked) {
    addLike($conn, $id, $user_id);
    header("Location: post.php?id=$id");
    exit;
}

if (isset($_GET['like']) && $_GET['like'] == 2 && $isLiked) {
    removeLike($conn, $id, $user_id);
    header("Location: post.php?id=$id");
    exit;
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$sql = "SELECT tytul, zdjecie, liczbaLike, id_autor, id_tag ,users.nazwa as nazwa, tagi.nazwa as tag 
        FROM posty
        JOIN users ON users.id = posty.id_autor
        JOIN tagi ON tagi.id = posty.id_tag
        WHERE posty.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$row) {
    die("Post nie istnieje.");
}

// URL do obrazka
$imageUrl = "image.php?id=" . $id;

// echo "USER ID: ".$user_id;
// echo "USER NAME: ".$user_name;
// echo "POST ID: ".$id;


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['tytul']; ?></title>
    <link rel="stylesheet" href="./style/post.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="post.js"></script>
</head>
<body>

    <nav>
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

<section id="loginModal" class="loginModal" onclick="closeModal(this)">
    <section class="loginModalContent" onclick="event.stopPropagation()">
        <p class="loginModalText">Musisz się zalogować, aby polubić post</p>
        <!-- <a href="./login.php?lastPage=true" class="loginModalButton">LOGOWANIE</a> -->
        <a href="./login.php" class="loginModalButton">LOGOWANIE</a>

    </section>
</section>


    <section class="postContainer">
        <section class="nameContainer">
            <p class="title"><?php echo htmlspecialchars($row['tytul']); ?></p>
        </section>
        <img class='mainImg' src='<?php echo $imageUrl; ?>' alt='Obraz posta'>

    </section>

    <section class="likeContainer">
        <a class="likeButton" <?php 
        if ($isLoggedIn)
            {echo 'href="post.php?id='.$id.'&like='.($isLiked?2:1).'"';
            } else {echo 'onclick="openModal()"';}
                
        ?>>
            <?php if ($isLiked): ?>
                <img class="heart" src="./ikony/serce2.png" alt="Like">
            <?php else: ?>
                <img class="heart" src="./ikony/serce.png" alt="Like">
            <?php endif; ?>
        </a>
        <p class='likesCount'><?php echo $row['liczbaLike']; ?></p>
    </section>

    <section class="textContainer">
        <?php echo "<a href='index.php?tag=".$row['id_tag']."'>".$row['tag']."</a>" ?>
        <?php echo "<a href='user.php?id=".$row['id_autor']."'>@".$row['nazwa']."</a>" ?>
    </section>
</main>

</body>
</html>


