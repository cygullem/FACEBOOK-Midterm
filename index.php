<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="png" href="./Assets/Facebook-Logo.png">
    <title>Gullem Chatbook | Midterm</title>
    <link rel="stylesheet" href="./CSS/login.css">
    <link rel="stylesheet" href="./CSS/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container flex">
        <div class="facebook-page flex">
            <div class="text">
                <h1>Chatbook</h1>
                <p>Connect with friends and the world </p>
                <p>around you on Facebook.</p>
            </div>
            <div class="right">
                <form id="login-form" class="login-form" action="login.php" method="POST" enctype="multipart/form-data">
                    <input type="email" placeholder="Email or phone number" name="userEmail">

                    <div class="password-container">
                        <input type="password" placeholder="Password" name="userPassword" id="passwordField">
                        <i class="fa-regular fa-eye" id="togglePassword"></i>
                    </div>


                    <div class="link">
                        <input type="submit" name="submit" value="Log In" class="login"></input>
                        <a href="#" class="forgot">Forgot password?</a>
                    </div>
                    <hr>
                    <div class="button">
                        <a id="showPopupButton">Create new account</a>
                    </div>
                </form>
                <div class="creating-a-page">
                    <p class="create">
                        <strong>Create a page</strong> for a celebrity, brand or business.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="signup-popup" id="signupPopup">
        <div class="signup-container">
            <div class="signup-title">
                <div class="st-U">
                    <p>Sign Up</p>
                    <i class="fa-solid fa-xmark" id="closePopupIcon"></i>
                </div>
                <div class="st-D">
                    <p>It's quick and easy.</p>
                </div>
            </div>
            <div class="signup-content">
                <form id="signup-form" class="signup-form" action="signup.php" method="POST">
                    <div class="sf-flname">
                        <input type="text" placeholder="First name" name="firstName">
                        <input type="text" placeholder="Last name" name="lastName">
                    </div>
                    <input type="text" placeholder="Mobile number or email" name="username">
                    <div class="SU-passwordContainer">
                        <input type="password" placeholder="New password" name="password" id="SUpasswordField">
                        <i class="fa-regular fa-eye" id="toggleSUPassword"></i>
                    </div>
                    <div class="signup-Btn">
                        <button type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./JS/script.js"></script>
    <script src="./JS/main.js"></script>
</body>

</html>