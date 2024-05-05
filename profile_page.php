<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

include 'dbconnection.php';

$email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT firstname, lastname, profile_picture FROM login_table WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['lastname'] = $user['lastname'];
    $_SESSION['profile_picture'] = isset($user['profile_picture']) ? $user['profile_picture'] : "./Assets/default-profilepicture.png";
} else {
    $_SESSION['firstname'] = "Guest";
    $_SESSION['lastname'] = "";
    $_SESSION['profile_picture'] = "./Assets/default-profilepicture.png";
}


$userEmail = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT id FROM login_table WHERE email = ?");
$stmt->execute([$userEmail]);
$userId = $stmt->fetchColumn();

if ($userId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS follower_count FROM user_following WHERE followed_id = ?");
    $stmt->execute([$userId]);
    $followerCount = $stmt->fetchColumn();
} else {
    $followerCount = 0;
}

$followCountHTML = '<p class="follow_count">' . $followerCount . ' followers</p>';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="https://img.icons8.com/fluency/48/facebook-new.png">
    <title>Profile | Facenote</title>
    <link rel="stylesheet" href="./CSS/profilepage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav>
        <div class="fb-search">
            <div class="logo" onclick="toggleRefresh()">
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
            <div class="FBM" id="postContent" onclick="goToMainPage()">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div class="FBM">
                <i class="fa-brands fa-facebook-messenger"></i>
            </div>
            <div class="FBM">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="FBM user_Profile" onclick="openUserProfileMenu()">
                <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile">
                <div class="UP-drpdwn">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
            </div>
            <div class="UP-menu_container" id="UPmc">
                <div class="upmc">
                    <div class="upmc_Upper">
                        <div class="upmcU _settings">
                            <div class="upmcU_right">
                                <i class="fa-solid fa-gear changeColor"></i>
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

    <section class="junalisa">
        <div class="section_header">
            <div class="SH sh_1">
                <img src="./Assets/lanscapeCanada.png" alt="Cover Photo">
                <div class="addCoverPhoto">
                    <i class='bx bxs-camera'></i>
                    Edit cover photo
                </div>
            </div>
            <div class="SH sh_2">
                <div class="sh_ProfileCont">
                    <img id="profilePicture" src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture">
                </div>
                <div class="sh2_camera" id="cameraIcon">
                    <i class='bx bxs-camera'></i>
                    <input type="file" id="profilePictureInput" style="display: none;">
                </div>
                <div class="sh2_cont">
                    <div class="sh2a">
                        <p class="sh2a_Username"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></p>
                        <p class="follow_count"><?php echo $followCountHTML ?></p>
                    </div>
                    <div class="sh2b">
                        <div class="sh2b_options">
                            <div class="sh2bo_1">
                                <i class="fa-solid fa-plus"></i>
                                Add to story
                            </div>
                            <div class="sh2bo_1 sh2boH">
                                <i class="fa-solid fa-pen"></i>
                                Edit profile
                            </div>
                            <div class="sh2bo_2 sh2boH">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="SH sh_3">
                <div class="sh3_Cont">
                    <div class="sh3C_left">
                        <div class="sch3CL">Posts</div>
                        <div class="sch3CL">About</div>
                        <div class="sch3CL">Friends</div>
                        <div class="sch3CL">Photos</div>
                        <div class="sch3CL">Videos</div>
                        <div class="sch3CL">Reels</div>
                        <div class="sch3CL">
                            More
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="sh3C_right">
                        <div class="sch3CR">
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_body"></div>
    </section>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./JS/main.js"></script>
    <script src="./JS/profilepage.js"></script>
</body>

</html>