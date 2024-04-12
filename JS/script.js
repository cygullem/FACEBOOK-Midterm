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
function togglePassword(passwordFieldId, toggleIconId) {
    var passwordField = document.getElementById(passwordFieldId);
    var icon = document.getElementById(toggleIconId);
    
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

document.getElementById('togglePassword').addEventListener('click', function() {
    togglePassword('passwordField', 'togglePassword');
});

document.getElementById('toggleSUPassword').addEventListener('click', function() {
    togglePassword('SUpasswordField', 'toggleSUPassword');
});
