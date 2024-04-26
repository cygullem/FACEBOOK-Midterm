document.addEventListener("DOMContentLoaded", function () {
    const postContent = document.getElementById("postContent");
    const popupContainer = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    postContent.addEventListener("click", function () {
        popupContainer.style.display = "block";
    });

    closePopupBtn.addEventListener("click", function () {
        popupContainer.style.display = "none";
    });
});


// OPEN POSTING POPUP WHEN USER CLICK THE "users_Followers" div
document.addEventListener("DOMContentLoaded", function() {
    const triggerDivs = document.querySelectorAll("._postTrigg");
    const popupContainer1 = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    triggerDivs.forEach(function(triggerDiv) {
        triggerDiv.addEventListener("click", function() {
            popupContainer1.style.display = "block";
        });
    });

    closePopupBtn.addEventListener("click", function () {
        popupContainer1.style.display = "none";
    });
});



//SIGN-UP POPUP
document.addEventListener("DOMContentLoaded", function () {
    var showPopupButton = document.getElementById("showPopupButton");

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



//VIEW PASSWORD
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
document.getElementById('passwordField').addEventListener('input', function () {
    var passwordField = document.getElementById('passwordField');
    var icon = document.getElementById('togglePassword');
    icon.style.display = passwordField.value ? 'inline-block' : 'none';
});

// Toggle password visibility when eye icon is clicked
document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordField = document.getElementById('passwordField');
    var icon = document.getElementById('togglePassword');
    togglePassword(passwordField, icon);
});

// Show eye icon when user starts typing in sign up password
document.getElementById('SUpasswordField').addEventListener('input', function () {
    var passwordField = document.getElementById('SUpasswordField');
    var icon = document.getElementById('toggleSUPassword');
    icon.style.display = passwordField.value ? 'inline-block' : 'none';
});

// Toggle password visibility when eye icon is clicked for sign up password
document.getElementById('toggleSUPassword').addEventListener('click', function () {
    var passwordField = document.getElementById('SUpasswordField');
    var icon = document.getElementById('toggleSUPassword');
    togglePassword(passwordField, icon);
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
const container = document.querySelector(".container"),
    privacy = container.querySelector(".post .privacy"),
    arrowBack = container.querySelector(".audience .arrow-back");
privacy.addEventListener("click", () => {
    container.classList.add("active");
});
arrowBack.addEventListener("click", () => {
    container.classList.remove("active");
});

function closePostPopup() {
    var closePopup = document.getElementById("popupContainer");

    closePopup.style.display = "none";
}


// POST CONTAINER POPUP
document.addEventListener("DOMContentLoaded", function () {
    const postContent = document.getElementById("postContent");
    const popupContainer = document.getElementById("popupContainer");
    const closePopupBtn = document.getElementById("closePopup");

    console.log("DOMContentLoaded event triggered");

    postContent.addEventListener("click", function () {
        popupContainer.style.display = "block";
    });

    closePopupBtn.addEventListener("click", function () {
        popupContainer.style.display = "none";
    });
});


// USER PROFILE MENU
function openUserProfileMenu() {
    var modal = document.getElementById('UPmc');
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'block';
    } else {
        modal.style.display = 'none';
    }
}

document.querySelector('.FBM .user_Profile').addEventListener('click', openUserProfileMenu);

document.addEventListener('click', function(event) {
    var modal = document.getElementById('UPmc');
    var profileTrigger = document.querySelector('.FBM.user_Profile');
    if (!modal.contains(event.target) && event.target !== profileTrigger) {
        modal.style.display = 'none';
    }
});



document.querySelector('.content-Center').addEventListener('mouseenter', function() {
    this.style.overflowY = 'auto';
});

document.querySelector('.content-Center').addEventListener('mouseleave', function() {
    this.style.overflowY = 'hidden';
});


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