<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="https://img.icons8.com/fluency/48/facebook-new.png">
    <title>Welcome to Facenote</title>
    <link rel="stylesheet" href="./CSS/friendsList.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="link">
    <nav>
        <div class="fb-search">
            <div class="logo">
                <!-- <img src="./Assets/Facebook-Logo.png" alt=""> -->
                <img width="48" height="48" src="https://img.icons8.com/fluency/48/facebook-new.png" alt="facebook-new" />
            </div>
            <div class="search-bar">
                <form action="">
                    <input type="text" placeholder="Search Facenote">
                    <i class='bx bx-search-alt-2'></i>
                </form>
            </div>
        </div>
        <div class="fb-content">
            <a href="mainpage.php" id="myLink">
                <div class="FBC fbchome">
                    <i class='bx bx-home-alt' id="homeIcon"></i>
                </div>
            </a>
            <a href="friendsList.php">
                <div class="FBC friends">
                    <i class='bx bx-group' id="friendsIcon"></i>
                    <div class="underline"></div>
                </div>
            </a>
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
                    <div class="upmc_Upper">
                        <div class="upmcU _settings">
                            <div class="upmcU_right">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            <div class="upmcU_left">Settings & privacy</div>
                        </div>
                        <div class="upmcU _helpSupport">
                            <div class="upmcU_right">
                                <i class='bx bxs-help-circle'></i>
                            </div>
                            <div class="upmcU_left">Help & support</div>
                        </div>
                        <div class="upmcU _giveFeedback">
                            <div class="upmcU_right">
                                <i class='bx bxs-comment-error'></i>
                            </div>
                            <div class="upmcU_left">Give Feedback</div>
                        </div>
                        <a href="logout.php" class="upmcU" id="logout">
                            <div class="upmcU_right">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>
                            <div class="upmcU_left">Log Out</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="friendsList_Container">
        <div class="FLC-Left">
            <div class="flcl_menu">
                <h1>Friends</h1>
                <div class="flcl_menu-settings">
                    <i class="fa-solid fa-gear"></i>
                </div>
            </div>
        </div>
        <div class="FLC-Right">
            <div class="flcr_header">
                <h2>People you may know</h2>
                <div class="see_all">
                    See all
                </div>
            </div>
            <div class="flcr_container">
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>

                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>

                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>

                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
                <div class="user_follow"></div>
            </div>
        </div>
    </section>


    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./JS/script.js"></script>
</body>

</html>