<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="./Assets/Facebook-Logo.png">
    <title>Welcome to Chatnote</title>
    <link rel="stylesheet" href="./CSS/mainpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav>
        <div class="fb-search">
            <div class="logo">
                <img src="./Assets/Facebook-Logo.png" alt="">
            </div>
            <div class="search-bar">
                <form action="">
                    <input type="text">
                </form>
            </div>
        </div>
        <div class="fb-content"></div>
        <div class="fb-menu"></div>
    </nav>

    <section>
        <h1>
            WELCOME TO CHATBOOK
        </h1>

        <a href="logout.php" id="logout">Logout</a>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./JS/script.js"></script>
</body>

</html>