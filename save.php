<div class="users_Posts">
    <div class="usrsP_1">
        <div class="usrsp1left">
            <div class="usrsp1left_01">
                <img src="./Assets/UserProfile.png" alt="Profile">
            </div>
            <div class="usrsp1left_02">
                <p>Cy Gullem</p>
                <span>a day ago &#183; <i class='fa-solid fa-user-group'></i></span>
            </div>
        </div>
        <div class="usrsp1right">
            <div class="usrsp1right_icon" onclick="usrspEditDelete()" id="usrspEditDelete">
                <i class="fa-solid fa-ellipsis"></i>
                <div class="usrsp_options">
                    <p>Edit</p>
                    <p>Delete</p>
                </div>
                <div class="triangle"></div>
            </div>
        </div>
    </div>
    <div class="usrsP_caption">
        <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Aperiam, impedit tempora provident quod sint exercitationem non omnis magnam nesciunt tenetur!
        </p>
    </div>

    <div class="usrsP_imagePosted">
        <img src="./Assets/lanscapeCanada.png" alt="Posted Image">
    </div>

    <div class="usrsP_activities">
        <div class="usrsP_ like">
            <i class='bx bx-like'></i>
            <p>Like</p>
        </div>
        <div class="usrsP_ comment">
            <i class="fa-regular fa-comment"></i>
            <p>Comment</p>
        </div>
        <div class="usrsP_ share">
            <i class='bx bx-share'></i>
            <p>Share</p>
        </div>
    </div>

    <div class="usrsP_comment">
        <div class="usrspcomL">
            <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Image">
        </div>
        <div class="usrspcomR">
            <form action="">
                <input type="text" placeholder="Comment as <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>">
            </form>
        </div>
    </div>
</div>



<!-- Comment Modal -->
<div id="commentPostModal" class="comment_Modal">
    <div class="comment_ModalContent">
        <div class="titleContainer">
            <!-- Display here the firstname lastname of the owner of the post -->
            <h1>Cy Gullem's Post</h1>
            <div class="TCclose" onclick="closeCommentModal()">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="commentContainer">

            <div class="userComment">
                <div class="userprofilecomment">
                    <div class="upc_profile">
                        <!-- Display here the profile picture of the user who commented in this post -->
                        <img src="./Assets/default-profilepicture.png" alt="">
                    </div>
                </div>
                <div class="users_comment">
                    <div class="graycontainer">
                        <div class="usernamecomment">
                            <!-- Display here the firstname lastname of the user who commented in this post -->
                            <p>Cy Gullem</p>
                        </div>
                        <div class="user_comment_area">
                            <!-- Display here the user's comment in this post -->
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Laboriosam ipsa asperiores sapiente? Dolorum magnam cum in nisi atque at ea!
                        </div>
                    </div>
                    <!-- This div is optional. 
                                If the user who commented is the logged in user add this div if not don't add this div-->
                    <div class="edit_delete_comment">
                        <p>Edit</p>
                        <p>Delete</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>