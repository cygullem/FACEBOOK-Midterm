$(document).ready(function() {
    function fetchFollowedAccounts() {
        var userEmail = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";

        $.ajax({
            type: 'GET',
            url: 'fetch_following.php',
            data: { userEmail: userEmail },
            dataType: 'json',
            success: function(response) {
                $('.content-Right .following_container').empty();

                response.forEach(function(account) {
                    var profileContainer = $('<div>').addClass('following_container');
                    var profileImg = $('<div>').addClass('fc-img').append($('<img>').attr('src', account.profile_picture).attr('alt', 'Profile picture'));
                    var profileName = $('<div>').addClass("uname_followed").text(account.firstname + ' ' + account.lastname);

                    var unfollowBtn = $('<div>').addClass('unfollowBtn').html('<i class="fa-solid fa-xmark"></i>');

                    unfollowBtn.click(function() {
                        var friendId = account.id; 
                        var accountName = account.firstname + ' ' + account.lastname;
                        var confirmMsg = "Are you sure you want to unfollow " + accountName + "?";
                        
                        var confirmUnfollow = confirm(confirmMsg);
                        
                        if (confirmUnfollow) {
                            console.log("Unfollowing user with ID: " + friendId);
                            unfollowUser(friendId); 
                            location.reload(); 
                        }
                    });

                    profileContainer.append(profileImg, profileName, unfollowBtn);
                    $('.content-Right').append(profileContainer);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while fetching followed accounts.');
            }
        });
    }
    fetchFollowedAccounts();



    // Function to unfollow a user
    function unfollowUser(friendId) {
        $.ajax({
            type: 'POST',
            url: 'unfollow.php',
            data: { friendId: friendId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    fetchFollowedAccounts(); 
                } else {
                    console.error(response.message); 
                    alert('Failed to unfollow user.'); 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while unfollowing user.');
            }
        });
    }



    // Signup AJAX Request
    $('#signup-form').submit(function(e) {
        e.preventDefault(); 

        var firstName = $('#signup-form input[name="firstName"]').val();
        var lastName = $('#signup-form input[name="lastName"]').val();
        var email = $('#signup-form input[name="username"]').val();
        var password = $('#signup-form input[name="password"]').val();

        if (firstName === '' || lastName === '' || email === '' || password === '') {
            alert('Please fill in all fields');
            return; 
        }
        
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'signup.php',
            data: formData,
            success: function(response) {
                var jsonData = JSON.parse(response);
                
                if (jsonData.status === 'success') {
                    alert(jsonData.message); 
                    window.location.href = 'index.php'; 
                } else {
                    alert(jsonData.message); 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred. Please try again later.'); 
            }
        });
    });



    // Login AJAX Request
    $('#login-form').submit(function(e) {
        e.preventDefault(); 

        var email = $('#login-form input[name="userEmail"]').val();
        var password = $('#login-form input[name="userPassword"]').val();

        if (email === '' || password === '') {
            alert('Please fill in all fields');
            return; 
        }

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: formData,
            success: function(response) {
                var jsonData = JSON.parse(response);

                if (jsonData.status === 'success') {
                    alert(jsonData.message); 
                    window.location.href = 'mainpage.php'; 
                } else {
                    alert(jsonData.message); 
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred. Please try again later.');
            }
        });
    });



    // Logout AJAX Request
    $('#logout-form').submit(function(e) {
        e.preventDefault();
    
        if (window.confirm('Are you sure you want to log out?')) {
            $.ajax({
                type: 'POST',
                url: 'logout.php',
                success: function() {
                    window.location.href = 'index.php';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred during logout');
                }
            });
        }
    });



    // Function to fetch accounts
    function fetchAccounts() {
        var userEmail = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";
        
        $.ajax({
            type: 'GET',
            url: 'fetch_accounts.php',
            data: { userEmail: userEmail }, 
            dataType: 'json',
            success: function(response) {
                $('.flcr_container').empty(); 
                response.forEach(function(account) {
                    var profile = $('<div>').addClass('user_follow').attr('data-user-id', account.id); 
                    var profileImg = $('<img>').attr('src', account.profile_picture).attr('alt', 'Profile Picture');
                    var profileInfo = $('<div>').addClass('uf_info');
                    var profileName = $('<h3>').text(account.firstname + ' ' + account.lastname);
                    var followBtn = $('<button>').addClass('followBtn').text('Follow');
                    var removeBtn = $('<button>').addClass('removeBtn').text('Remove');
                    
                    profileInfo.append(profileName, followBtn, removeBtn);
                    profile.append(profileImg, profileInfo);
                    $('.flcr_container').append(profile);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while fetching accounts.');
            }
        });
    }
    fetchAccounts();



    // Follow & Remove Button Click Event
    $(document).on('click', '.followBtn, .removeBtn', function() {
        var friendId = $(this).closest('.user_follow').attr('data-user-id');
        var isFollowAction = $(this).hasClass('followBtn'); 

        $.ajax({
            type: 'POST',
            url: isFollowAction ? 'follow.php' : 'unfollow.php', 
            data: { friendId: friendId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    fetchAccounts();
                } else {
                    alert(response.message);
                }
            },            
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while ' + (isFollowAction ? 'following' : 'unfollowing'));
            }
        });
    });    
});
