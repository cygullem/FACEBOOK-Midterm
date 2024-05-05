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