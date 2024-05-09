document.addEventListener("DOMContentLoaded", function () {
    const postContent = document.getElementById("postContent");
    const popupContainer = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    postContent.addEventListener("click", function () {
        popupContainer.style.display = "block";
    });

    if (closePopupBtn) { // Check if closePopupBtn exists
        closePopupBtn.addEventListener("click", function () {
            popupContainer.style.display = "none";
        });
    }
});



// POST POPUP
document.addEventListener("DOMContentLoaded", function() {
    const triggerDivs = document.querySelectorAll("._postTrigg");
    const popupContainer1 = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    triggerDivs.forEach(function(triggerDiv) {
        triggerDiv.addEventListener("click", function() {
            popupContainer1.style.display = "block";
        });
    });

    if (closePopupBtn) { // Check if closePopupBtn exists
        closePopupBtn.addEventListener("click", function () {
            popupContainer1.style.display = "none";
        });
    }
});



//SIGN-UP POPUP
document.addEventListener("DOMContentLoaded", function () {
    var showPopupButton = document.getElementById("showPopupButton");

    if (showPopupButton) { // Check if showPopupButton exists
        var signupPopup = document.getElementById("signupPopup");
        var closePopupIcon = document.getElementById("closePopupIcon");

        showPopupButton.addEventListener("click", function (event) {
            event.preventDefault();

            if (signupPopup) {
                signupPopup.style.display = "flex";
            }
        });

        closePopupIcon.addEventListener("click", function () {
            if (signupPopup) {
                signupPopup.style.display = "none";
            }
        });

        window.addEventListener("click", function (event) {
            if (signupPopup && event.target === signupPopup) {
                signupPopup.style.display = "none";
            }
        });
    }
});



//LOGOUT
$(function () {
    $('a#logout').click(function () {
        if (confirm('Are you sure to logout')) {
            return true;
        }

        return false;
    });
});



// Get references to the password field and the eye icon
var passwordField = document.getElementById('passwordField');
var togglePasswordIcon = document.getElementById('togglePassword');

// Check if togglePasswordIcon exists before adding event listener
if (togglePasswordIcon) {
    togglePasswordIcon.addEventListener('click', function() {
        togglePassword(passwordField, togglePasswordIcon);
    });
}

function togglePassword(passwordField, icon) {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}





// Show eye icon when user starts typing
document.addEventListener("DOMContentLoaded", function() {
    var passwordField = document.getElementById('passwordField');
    if (passwordField) {
        passwordField.addEventListener('input', function () {
            var icon = document.getElementById('togglePassword');
            icon.style.display = passwordField.value ? 'inline-block' : 'none';
        });
    }
});



// Toggle password visibility when eye icon is clicked
document.addEventListener("DOMContentLoaded", function() {
    var togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            var passwordField = document.getElementById('passwordField');
            togglePasswordVisibility(passwordField, togglePassword);
        });
    }
});



// Show eye icon when user starts typing in sign up password
document.addEventListener("DOMContentLoaded", function() {
    var SUpasswordField = document.getElementById('SUpasswordField');
    var toggleSUPassword = document.getElementById('toggleSUPassword');

    if (SUpasswordField && toggleSUPassword) {
        SUpasswordField.addEventListener('input', function () {
            toggleSUPassword.style.display = SUpasswordField.value ? 'inline-block' : 'none';
        });

        toggleSUPassword.addEventListener('click', function() {
            if (SUpasswordField.type === 'password') {
                SUpasswordField.type = 'text';
                toggleSUPassword.classList.remove('fa-eye');
                toggleSUPassword.classList.add('fa-eye-slash');
            } else {
                SUpasswordField.type = 'password';
                toggleSUPassword.classList.remove('fa-eye-slash');
                toggleSUPassword.classList.add('fa-eye');
            }
        });
    }
});




// Toggle password visibility when eye icon is clicked for sign up password
document.addEventListener("DOMContentLoaded", function() {
    var toggleSUPassword = document.getElementById('toggleSUPassword');
    if (toggleSUPassword) {
        toggleSUPassword.addEventListener('click', function () {
            var passwordField = document.getElementById('SUpasswordField');
            togglePasswordVisibility(passwordField, toggleSUPassword);
        });
    }
});



// CONTENT ICONS COLORS WHEN ACTIVE 
document.addEventListener("DOMContentLoaded", function () {
    const iconContainers = document.querySelectorAll(".FBC");

    iconContainers.forEach(container => {
        container.addEventListener("click", function () {
            document.querySelectorAll('.FBC i').forEach(icon => {
                icon.classList.remove("active");
            });

            const icon = container.querySelector('i');
            icon.classList.add("active");
        });
    });
});



// POSTING SCRIPT
const container = document.querySelector(".container");

if (container) {
    const privacy = container.querySelector(".post .privacy");
    if (privacy) {
        privacy.addEventListener("click", () => {
            container.classList.add("active");
        });
    }

    const arrowBack = container.querySelector(".audience .arrow-back");
    if (arrowBack) {
        arrowBack.addEventListener("click", () => {
            container.classList.remove("active");
        });
    }
}




// POST CONTAINER POPUP
document.addEventListener("DOMContentLoaded", function () {
    const postContent = document.getElementById("postContent");
    const popupContainer = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    postContent.addEventListener("click", function () {
        popupContainer.style.display = "block";
    });

    if (closePopupBtn) {
        closePopupBtn.addEventListener("click", function () {
            popupContainer.style.display = "none";
        });
    }
});
function closePostPopup() {
    const popupContainer = document.getElementById("popupContainer");
    popupContainer.style.display = "none";
}




// USER PROFILE MENU
function openUserProfileMenu() {
    var modal = document.getElementById('UPmc');
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'block';
    } else {
        modal.style.display = 'none';
    }
}



// Open the modal when the user clicks on the user profile button
document.addEventListener("DOMContentLoaded", function() {
    var user_Profile = document.querySelector('.FBM .user_Profile');
    if (user_Profile) {
        user_Profile.addEventListener('click', function(event) {
            event.stopPropagation();
            openUserProfileMenu();
        });
    }
});



// Select the element with the class .content-Center
const contentCenter = document.querySelector('.content-Center');

if (contentCenter) {
    contentCenter.addEventListener('mouseenter', function() {
        this.style.overflowY = 'auto';
    });
}

if (contentCenter) {
    contentCenter.addEventListener('mouseleave', function() {
        this.style.overflowY = 'hidden';
    });
}



function goToMainPage() {
    if (confirm("Unable to post here, go to mainpage instead?")) {
        window.location.href = "mainpage.php"
    } else {
        exit;
    }
}



function toggleRefresh() {
    window.location.href = "mainpage.php";
}



//Redirect to Profile Page
function redirectToProfilePage() {
    window.location.href = "profile_page.php";
}


function usrspEditDelete() {
    var optionsDiv = document.querySelector('.usrsp_options');
    var triangleDiv = document.querySelector('.triangle');

    if (optionsDiv.style.display === 'block') {
        optionsDiv.style.display = 'none';
        triangleDiv.style.display = 'none';
    } else {
        optionsDiv.style.display = 'block';
        triangleDiv.style.display = 'block';
    }
}

// fetch comments for a specific post ID
function popupCommentModal(postId) {
    console.log("Post ID:", postId); // Debugger

    var modal = document.getElementById("commentPostModal");
    modal.style.display = "block";

    $.ajax({
        type: 'POST',
        url: 'fetch_comments.php',
        data: { post_id: postId },
        dataType: 'json',
        success: function(response) {
            $('.commentContainer').empty();

            $('.titleContainer h1').text(response.ownerName + "'s Post");

            response.comments.forEach(function(comment) {
                var commentHtml = `
                    <div class="userComment">
                        <div class="userprofilecomment">
                            <div class="upc_profile">
                                <img src="${comment.profile_picture}" alt="">
                            </div>
                        </div>
                        <div class="users_comment">
                            <div class="graycontainer">
                                <div class="usernamecomment">
                                    <p>${comment.firstname} ${comment.lastname}</p>
                                </div>
                                <div class="user_comment_area">
                                    ${comment.comment}
                                </div>
                            </div>
                            <!-- Add edit and delete options if the comment belongs to the logged-in user -->
                            ${comment.user_id === response.loggedInUserId ? `
                            <div class="edit_delete_comment">
                                <p>Edit</p>
                                <p>Delete</p>
                            </div>` : ''}
                        </div>
                    </div>`;
                $(".commentContainer").prepend(commentHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred while fetching comments:", error);
            console.log("Response text:", xhr.responseText);
            console.log("Status code:", xhr.status);
        }        
    });
}




// Function to close the comment modal
function closeCommentModal() {
    var modal = document.getElementById("commentPostModal");
    modal.style.display = "none";
}
