//SIGN-UP POPUP
document.addEventListener("DOMContentLoaded", function() {
    var showPopupButton = document.getElementById("showPopupButton");

    var signupPopup = document.getElementById("signupPopup");

    var closePopupIcon = document.getElementById("closePopupIcon");

    showPopupButton.addEventListener("click", function(event) {
        event.preventDefault(); 

        if (signupPopup) {
            signupPopup.style.display = "flex";
        }
    });

    closePopupIcon.addEventListener("click", function() {
        if (signupPopup) {
            signupPopup.style.display = "none";
        }
    });

    window.addEventListener("click", function(event) {
        if (signupPopup && event.target === signupPopup) {
            signupPopup.style.display = "none";
        }
    });
});



//LOGOUT
$(function(){
    $('a#logout').click(function(){
        if(confirm('Are you sure to logout')) {
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
document.getElementById('passwordField').addEventListener('input', function() {
    var passwordField = document.getElementById('passwordField');
    var icon = document.getElementById('togglePassword');
    icon.style.display = passwordField.value ? 'inline-block' : 'none';
});

// Toggle password visibility when eye icon is clicked
document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('passwordField');
    var icon = document.getElementById('togglePassword');
    togglePassword(passwordField, icon);
});

// Show eye icon when user starts typing in sign up password
document.getElementById('SUpasswordField').addEventListener('input', function() {
    var passwordField = document.getElementById('SUpasswordField');
    var icon = document.getElementById('toggleSUPassword');
    icon.style.display = passwordField.value ? 'inline-block' : 'none';
});

// Toggle password visibility when eye icon is clicked for sign up password
document.getElementById('toggleSUPassword').addEventListener('click', function() {
    var passwordField = document.getElementById('SUpasswordField');
    var icon = document.getElementById('toggleSUPassword');
    togglePassword(passwordField, icon);
});



// CONTENT ICONS COLORS WHEN ACTIVE 
document.addEventListener("DOMContentLoaded", function() {
    const iconContainers = document.querySelectorAll(".FBC");

    iconContainers.forEach(container => {
        container.addEventListener("click", function() {
            document.querySelectorAll('.FBC i').forEach(icon => {
                icon.classList.remove("active");
            });

            const icon = container.querySelector('i');
            icon.classList.add("active");
        });
    });
});
