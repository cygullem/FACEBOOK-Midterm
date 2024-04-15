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
    <title>Welcome to Facenote</title>
    <link rel="stylesheet" href="./CSS/mainpage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                    <input type="text" placeholder="Search Facenote">
                    <i class='bx bx-search-alt-2'></i>
                </form>
            </div>
        </div>
        <div class="fb-content">
            <div class="FBC fbchome">
                <i class='bx bx-home-alt' id="homeIcon"></i>
                <div class="underline"></div>
            </div>
            <div class="FBC friends">
                <i class='bx bx-group' id="friendsIcon"></i>
            </div>
            <div class="FBC market">
                <i class='bx bx-store-alt' id="marketIcon"></i>
            </div>
            <div class="FBC groups">
                <i class='bx bx-user-circle' id="groupsIcon"></i>
            </div>
            <div class="FBC games">
                <i class="fa-solid fa-gamepad" id="gamesIcon"></i>
            </div>
        </div>
        <div class="fb-menu">
            <div class="FBM" id="postContent">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div class="FBM">
                <i class="fa-brands fa-facebook-messenger"></i>
            </div>
            <div class="FBM">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="FBM user_Profile" onclick="openUserProfileMenu()">
                <img src="Assets/UserProfile.png" alt="Profile">
                <div class="UP-drpdwn">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
            </div>
            <div class="UP-menu_container" id="UPmc">
                <div class="upmc">

                </div>
            </div>
        </div>
    </nav>

    <section class="content-container">
        <div class="content-Left">

        </div>
        <div class="content-Center">
            <h1>WELCOME TO FACENOTE</h1>
            <a href="logout.php" id="logout">Logout</a>
        </div>
        <div class="content-Right"></div>
    </section>

    <div class="popup-container" id="popupContainer">
        <div class="popup">
            <div class="container">
                <div class="wrapper">
                    <section class="post">
                        <header>
                            Create Post
                            <div class="header-closeBtn" onclick="closePostPopup()">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                        </header>
                        <form action="#">
                            <div class="content">
                                <img src="Assets/UserProfile.png" alt="logo">
                                <div class="details">
                                    <p>Cy Gullem</p>
                                    <div class="privacy">
                                        <i class="fas fa-user-friends"></i>
                                        <span>Friends</span>
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                            <textarea placeholder="Share your daily acitivity on Facenote" spellcheck="false" required></textarea>
                            <div class="theme-emoji">
                                <img src="icons/theme.svg" alt="theme">
                                <img src="icons/smile.svg" alt="smile">
                            </div>
                            <div class="options">
                                <p>Add to Your Post</p>
                                <ul class="list">
                                    <li><img src="icons/gallery.svg" alt="gallery"></li>
                                    <li><img src="icons/tag.svg" alt="gallery"></li>
                                    <li><img src="icons/emoji.svg" alt="gallery"></li>
                                    <li><img src="icons/mic.svg" alt="gallery"></li>
                                    <li><img src="icons/more.svg" alt="gallery"></li>
                                </ul>
                            </div>
                            <button>Post</button>
                        </form>
                    </section>
                    <section class="audience">
                        <header>
                            <div class="arrow-back"><i class="fas fa-arrow-left"></i></div>
                            <p>Select Audience</p>
                        </header>
                        <div class="content">
                            <p>Who can see your post?</p>
                            <span>Your post will show up in News Feed, on your profile and in search results.</span>
                        </div>
                        <ul class="list">
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-globe-asia"></i></div>
                                    <div class="details">
                                        <p>Public</p>
                                        <span>Anyone on or off Facenote</span>
                                    </div>
                                </div>
                                <div class="radio"></div>
                            </li>
                            <li class="active">
                                <div class="column">
                                    <div class="icon"><i class="fas fa-user-friends"></i></div>
                                    <div class="details">
                                        <p>Friends</p>
                                        <span>Your friends on Facenote</span>
                                    </div>
                                </div>
                                <div class="radio"></div>
                            </li>
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-user"></i></div>
                                    <div class="details">
                                        <p>Specific</p>
                                        <span>Only show to some friends</span>
                                    </div>
                                </div>
                                <div class="radio"></div>
                            </li>
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-lock"></i></div>
                                    <div class="details">
                                        <p>Only me</p>
                                        <span>Only you can see your post</span>
                                    </div>
                                </div>
                                <div class="radio"></div>
                            </li>
                            <li>
                                <div class="column">
                                    <div class="icon"><i class="fas fa-cog"></i></div>
                                    <div class="details">
                                        <p>Custom</p>
                                        <span>Include and exclude friends</span>
                                    </div>
                                </div>
                                <div class="radio"></div>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>



    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./JS/script.js"></script>
</body>

</html>