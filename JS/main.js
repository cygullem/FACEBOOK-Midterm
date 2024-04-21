$(document).ready(function() {
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
    
        // Display confirmation dialog
        if (window.confirm('Are you sure you want to log out?')) {
            // If user confirms, proceed with logout AJAX request
            $.ajax({
                type: 'POST',
                url: 'logout.php',
                success: function() {
                    // Redirect to index.php after successful logout
                    window.location.href = 'index.php';
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred during logout');
                }
            });
        }
    });


    // fetch all acounts: Follow or Delete
    $.ajax({
        type: 'GET',
        url: 'fetch_accounts.php',
        dataType: 'json',
        success: function(response) {
            // Loop through each account and display profile
            response.forEach(function(account) {
                // Create profile element
                var profile = $('<div>').addClass('user_follow');
                var profileImg = $('<img>').attr('src', account.profile_picture).attr('alt', 'Profile Picture');
                var profileInfo = $('<div>').addClass('uf_info');
                var profileName = $('<h3>').text(account.firstname + ' ' + account.lastname);
                var followBtn = $('<button>').addClass('followBtn').text('Follow');
                var removeBtn = $('<button>').addClass('removeBtn').text('Delete');
                
                // Append elements to profile
                profileInfo.append(profileName, followBtn, removeBtn);
                profile.append(profileImg, profileInfo);
                
                // Append profile to container
                $('.flcr_container').append(profile);
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while fetching accounts.');
        }
    });
});
