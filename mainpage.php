<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['email'])) {
    echo '<script>console.log("Email: ' . $_SESSION['email'] . '");</script>';
}

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

// Fetch the user ID from the session if it exists
$loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="https://img.icons8.com/fluency/48/facebook-new.png">
    <title>Welcome to Facenote</title>
    <link rel="stylesheet" href="./CSS/mainpage.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script> -->
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
            <a href="mainpage.php">
                <div class="FBC fbchome">
                    <i class="fa-solid fa-house" id="homeIcon"></i>
                    <div class="underline"></div>
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
            <div class="FBM" id="postContent">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div class="FBM">
                <i class="fa-brands fa-facebook-messenger"></i>
            </div>
            <div class="FBM realtime_Notifs" onclick="openNotifCont()">
                <i class="fa-solid fa-bell"></i>
                <div class="realtime_Notifs_Count">
                    <p>10</p>
                </div>
            </div>
            <div class="realtime_Notif_Container" id="rNC">
                <div class="rnc_container">
                    <div class="rnc_top">
                        <div class="rnct_title">
                            <h2>Notifications</h2>
                            <div>
                                <i class="fa-solid fa-ellipsis"></i>
                            </div>
                        </div>
                        <div class="rnct_au">
                            <div class="rnctau_all">All</div>
                            <div class="rnctau_unread">Unread</div>
                        </div>
                    </div>
                </div>

                
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

    <section class="content-container">
        <div class="content-Left">
            <div class="CL" onclick="redirectToProfilePage()">
                <div>
                    <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile">
                </div>
                <p><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></p>
            </div>
            <div class="CL">
                <div>
                    <img src="./SVG/Friends.png" alt="">
                </div>
                <p>Friends</p>
            </div>
            <div class="CL">
                <div>
                    <img class="memories" src="./SVG/Memories.png" alt="">
                </div>
                <p>Memories</p>
            </div>
            <div class="CL">
                <div>
                    <img class="saved" src="./SVG/Saved.png" alt="">
                </div>
                <p>Saved</p>
            </div>
            <div class="CL">
                <div>
                    <img class="groups1" src="./SVG/Groups.png" alt="">
                </div>
                <p>Groups</p>
            </div>
            <div class="CL">
                <div>
                    <img class="video" src="./SVG/Video.png" alt="">
                </div>
                <p>Video</p>
            </div>
            <div class="CL">
                <div>
                    <img class="marketplace" src="./SVG/Marketplace.png" alt="">
                </div>
                <p>Marketplace</p>
            </div>
            <div class="CL _seeMore">
                <div>
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <p>See more</p>
            </div>
            <hr class="line">
            <div class="urshortcut">
                <p>Your shortcuts</p>
            </div>
            <div class="SCL">
                <div>
                    <img src="./Assets/TBKK.png" alt="">
                </div>
                <p>TAGA BOGO KA KUNG??????</p>
            </div>
            <div class="SCL">
                <div>
                    <img src="./Assets/8BALLPOOL.png" alt="">
                </div>
                <p>8 Ball Pool</p>
            </div>
            <div class="SCL">
                <div>
                    <img src="./Assets/BASKETBALLSTARS.png" alt="">
                </div>
                <p>Basketball Stars</p>
            </div>
            <div class="SCL _Policies">
                <p>
                    Privacy &#183; Terms &#183; Advertising &#183; Ad Choices &#183; Cookies &#183; <br>
                    More &#183; Meta &copy; 2024
                </p>
            </div>
        </div>

        <div class="content-Center">
            <div class="users_Followers" id="users_Followers">
                <div class="Uf_cont">
                    <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile">
                    <div class="ask_Post  _postTrigg" id="ask_Post">
                        What's on your mind <?php echo $_SESSION['firstname'] ?>?
                    </div>
                </div>
                <div class="Uf_activity">
                    <div class="ufa_1  _postTrigg">
                        <i class="fa-solid fa-video"></i>
                        <p>Live video</p>
                    </div>
                    <div class="ufa_2  _postTrigg">
                        <i class="fa-solid fa-images"></i>
                        <p>Photo/video</p>
                    </div>
                    <div class="ufa_3  _postTrigg">
                        <i class="fa-regular fa-face-laugh"></i>
                        <p>Feeling/activity</p>
                    </div>
                </div>
            </div>

            <!-- Posts will be generated here using the ajax -->

            <!-- Edit Post Modal -->
            <div id="editPostModal" class="modal">
                <div class="modal-content">
                    <span class="close closeEditPostModal" onclick="closeEditPostModal()"><i class="fa-solid fa-xmark"></i></span>
                    <h2>Edit Post</h2>
                    <form id="editPostForm">
                        <input type="hidden" id="postId">
                        <label for="editCaption">Caption:</label>
                        <textarea id="editCaption" name="editCaption" rows="4" cols="50"></textarea>
                        <label for="editImage">Image:</label>
                        <input type="file" id="editImage" name="editImage">
                        <button class="saveChangesBtn" type="submit">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- Comment Modal -->
            <div id="commentPostModal" class="comment_Modal">
                <div class="comment_ModalContent">
                    <div class="titleContainer">
                        <h1></h1>
                        <div class="TCclose" onclick="closeCommentModal()">
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                    </div>
                    <div class="commentContainer">
                        <!-- user comments will be generated here -->
                    </div>
                </div>
            </div>

            <!-- Edit Comment Modal -->
            <div id="editCommentModal" class="editCommentModal">
                <div class="editcomment_modalContent">
                    <span class="close closeEditCommentModal" onclick="closeEditCommentModal()"><i class="fa-solid fa-xmark"></i></span>
                    <h2>Edit Comment</h2>
                    <form id="editCommentForm">
                        <textarea id="editCommentTextarea" name="editComment" placeholder="Enter your edited comment"></textarea>
                        <input type="hidden" id="editCommentId" name="editCommentId">
                        <button class="saveChangesBtn" type="button" onclick="submitEditedComment()">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="content-Right">
            <div class="CR">
                <p>Sponsored</p>
                <div class="sponsored">
                    <div class="sponsored_img">
                        <img src="./Assets/Birdland.png" alt="Sponsor">
                    </div>
                    <div class="sponsored_label">
                        <span>
                            <strong>Birdland: Logo Maker and Designer</strong> <br>
                        </span>
                        <span class="sponsor_website">
                            www.birdland.com
                        </span>
                    </div>
                </div>
                <div class="sponsored">
                    <div class="sponsored_img">
                        <img src="./Assets/csg-logo.jpg" alt="Sponsor">
                    </div>
                    <div class="sponsored_label">
                        <span>
                            <strong>CSG: Your defender against cyberattacks</strong> <br>
                        </span>
                        <span class="sponsor_website">
                            www.csgdefender.com
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <p>Contacts</p>
            </div>
            <!-- <div class="following_container">
                <div class="fc-img">
                    <img src="Assets/default-profilepicture.png" alt="Profile picture">
                </div>
                <div>Dhaniel Malinao</div>
            </div> -->
        </div>
    </section>

    <div class="popup-container" id="popupContainer">
        <div class="popup">
            <div class="container_Post">
                <div class="wrapper">
                    <section class="post">
                        <header>
                            Create Post
                            <div class="header-closeBtn" onclick="closePostPopup()">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                        </header>

                        <form class="scroll" action="post.php" method="post" enctype="multipart/form-data">
                            <div class="content">
                                <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="logo">
                                <div class="details">
                                    <p><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></p>
                                    <div class="privacy">
                                        <i class="fas fa-user-friends"></i>
                                        <span>Friends</span>
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                            <textarea name="post_text" placeholder="What's on your mind <?php echo $_SESSION['firstname'] ?>?" spellcheck="false"></textarea>
                            <div class="post-scroll-effect">
                                <input type="file" name="image" id="imageInput" style="display: none;">
                                <div class="post-image">
                                    <img id="chosenImage" src="" alt=" ">
                                </div>
                            </div>
                            <div class="theme-emoji">
                                <img src="icons/theme.svg" alt="theme">
                                <img src="icons/smile.svg" alt="smile">
                            </div>
                            <div class="options">
                                <p>Add to Your Post</p>
                                <ul class="list">
                                    <li id="fileInputTrigger"><img src="icons/gallery.svg" alt="gallery"></li>
                                    <li><img src="icons/tag.svg" alt="gallery"></li>
                                    <li><img src="icons/emoji.svg" alt="gallery"></li>
                                    <li><img src="icons/mic.svg" alt="gallery"></li>
                                    <li><img src="icons/more.svg" alt="gallery"></li>
                                </ul>
                            </div>
                            <button type="submit">Post</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./JS/main.js"></script>
    <script src="./JS/script.js" data-userid="<?php echo json_encode($loggedInUserId); ?>"></script>
    <script src="./JS/openInputFile.js"></script>
</body>

</html>