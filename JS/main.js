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




    // AJAX code for fetching user's posts
    $.ajax({
        type: 'POST',
        url: 'fetch_user_posts.php',
        data: { user_email: "<?php echo $_SESSION['email']; ?>" },
        dataType: 'json',
        success: function(response) {
            // $(".users_Posts").empty();
            
            response.forEach(function(post) {
                var postHtml = `
                    <div class="users_Posts">
                        <div class="usrsP_1">
                            <div class="usrsp1left">
                                <div class="usrsp1left_01">
                                    <img src="${post.profile_picture}" alt="Profile">
                                </div>
                                <div class="usrsp1left_02">
                                    <p>${post.firstname} ${post.lastname}</p>
                                    <span>${post.created_at} &#183; <i class='fa-solid fa-user-group'></i></span>
                                </div>
                            </div>
                            <div class="usrsp1right">
                                <div class="usrsp1right_icon">
                                    <i class="fa-solid fa-ellipsis"></i>
                                    <div class="usrsp_options">
                                        <p class="edit-btn" data-post-id="${post.id}">Edit</p>
                                        <p class="delete-btn" data-post-id="${post.id}">Delete</p>
                                        </div>
                                        <div class="triangle">
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="usrsP_caption">
                            <p>${post.caption}</p>
                        </div>
                        <div class="usrsP_imagePosted">
                            ${post.imagePost ? `<img src="${post.imagePost}" alt="Posted Image">` : ''}
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
                                <img src="${post.profile_picture}" alt="Profile Image">
                            </div>
                            <div class="usrspcomR">
                                <form action="">
                                    <input type="text" placeholder="Comment as ${post.firstname} ${post.lastname}">
                                </form>
                            </div>
                        </div>
                    </div>`;
                
                $(".users_Followers").after(postHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred while fetching user's posts.");
        }
    });

    // Attach event listener to handle edit/delete button clicks for dynamically generated posts
    $(document).on('click', '.usrsp1right_icon', function() {
        $(this).find('.usrsp_options').toggle();
    });


    $(document).on('click', '.edit-btn', function() {
        var postId = $(this).data('post-id');
        
        $.ajax({
            type: 'POST',
            url: 'fetch_post_data.php',
            data: { postId: postId },
            dataType: 'json',
            success: function(post) {
                $('#postId').val(post.id);
                $('#editCaption').val(post.caption);
                $('#editPostModal').show();
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching post data.");
            }
        });
    });


    $(document).on("click", ".delete-btn", function() {
        var postId = $(this).data("post-id");
        
        if (confirm("Are you sure you want to delete this post?")) {
            $.ajax({
                type: "POST",
                url: "delete_post.php",
                data: { post_id: postId },
                dataType: "json",
                success: function(response) {
                    console.log("Post deleted successfully");
                    $(this).closest('.users_Posts').remove();
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Error deleting post");
                }
            });
        } else {
            console.log("Deletion canceled");
        }
    });
    
    


    // Handle form submission for editing the post
    $('#editPostForm').submit(function(event) {
        event.preventDefault();
        var postId = $('#postId').val();
        var editedCaption = $('#editCaption').val();
        var editedImage = $('#editImage').prop('files')[0];
        var formData = new FormData();
        formData.append('postId', postId);
        formData.append('caption', editedCaption);
        if (editedImage) {
            formData.append('image', editedImage);
        }
        $.ajax({
            type: 'POST',
            url: 'upload_posts.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                $('#editPostModal').hide();
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while updating the post.");
            }
        });
    });





    // Fetching the posts of every followed accounts
    $.ajax({
        type: 'POST',
        url: 'fetch_following_posts.php',
        dataType: 'json',
        success: function(response) {
            response.forEach(function(post) {
                var postHtml = `
                    <div class="users_Posts">
                        <div class="usrsP_1">
                            <div class="usrsp1left">
                                <div class="usrsp1left_01">
                                    <img src="${post.profile_picture}" alt="Profile">
                                </div>
                                <div class="usrsp1left_02">
                                    <p>${post.firstname} ${post.lastname}</p>
                                    <span>${post.created_at} &#183; <i class='fa-solid fa-user-group'></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="usrsP_caption">
                            <p>${post.caption}</p>
                        </div>
                        <div class="usrsP_imagePosted">
                            ${post.imagePost ? `<img src="${post.imagePost}" alt="Posted Image">` : ''}
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
                                <img src="${post.profile_picture}" alt="Profile Image">
                            </div>
                            <div class="usrspcomR">
                                <form action="">
                                    <input type="text" placeholder="Comment as ${post.firstname} ${post.lastname}">
                                </form>
                            </div>
                        </div>
                    </div>`;
                $(".users_Followers").after(postHtml);
            });
        },
        error: function(xhr, status, error) {
            console.error("An error occurred while fetching user's posts.");
        }
    });
        
    
      
});
