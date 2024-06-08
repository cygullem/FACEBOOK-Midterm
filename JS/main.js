$(document).ready(function() {
    $('.like-btn').on('click', function() {
        var postId = $(this).data('post-id');
        $.ajax({
            type: 'POST',
            url: 'like_post.php',
            data: { post_id: postId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message); // Or update the like count on the page
                } else {
                    console.error("Error liking post:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while liking the post:", error);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        fetchNotifications();
    
        document.querySelector('.rnctau_all').addEventListener('click', function() {
            document.querySelector('.rnctau_all').classList.add('active');
            document.querySelector('.rnctau_unread').classList.remove('active');
            fetchNotifications('all');
        });
    
        document.querySelector('.rnctau_unread').addEventListener('click', function() {
            document.querySelector('.rnctau_all').classList.remove('active');
            document.querySelector('.rnctau_unread').classList.add('active');
            fetchNotifications('unread');
        });
    });
    
    function fetchNotifications(filter = 'all') {
        $.ajax({
            type: 'GET',
            url: 'notifications.php',
            data: { filter: filter },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const notificationsList = document.getElementById('notificationsList');
                    notificationsList.innerHTML = '';
    
                    response.notifications.forEach(function(notification) {
                        const notificationItem = document.createElement('div');
                        notificationItem.className = 'user_Reaction_Comments';
    
                        const profilePic = document.createElement('img');
                        profilePic.src = notification.profile_picture;
    
                        const urcRight = document.createElement('div');
                        urcRight.className = 'urc_right';
                        urcRight.appendChild(profilePic);
    
                        const notificationText = document.createElement('div');
                        notificationText.className = 'ul_up';
                        notificationText.innerHTML = `<strong>${notification.firstname} ${notification.lastname}</strong> ${notification.message}`;
    
                        const notificationTime = document.createElement('div');
                        notificationTime.className = 'ul_down';
                        notificationTime.textContent = timeAgo(new Date(notification.notification_time));
    
                        const urcLeft = document.createElement('div');
                        urcLeft.className = 'urc_left';
                        urcLeft.appendChild(notificationText);
                        urcLeft.appendChild(notificationTime);
    
                        notificationItem.appendChild(urcRight);
                        notificationItem.appendChild(urcLeft);
    
                        notificationsList.appendChild(notificationItem);
                    });
                } else {
                    console.error("Error fetching notifications:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching notifications:", error);
            }
        });
    }
    
    function timeAgo(date) {
        const now = new Date();
        const secondsPast = (now.getTime() - date.getTime()) / 1000;
    
        if (secondsPast < 60) {
            return `${Math.round(secondsPast)} seconds ago`;
        }
        if (secondsPast < 3600) {
            return `${Math.round(secondsPast / 60)} minutes ago`;
        }
        if (secondsPast < 86400) {
            return `${Math.round(secondsPast / 3600)} hours ago`;
        }
        if (secondsPast < 2592000) {
            return `${Math.round(secondsPast / 86400)} days ago`;
        }
        if (secondsPast < 31104000) {
            return `${Math.round(secondsPast / 2592000)} months ago`;
        }
        return `${Math.round(secondsPast / 31104000)} years ago`;
    }



    function likePost(postId) {
        $.ajax({
            type: 'POST',
            url: 'like_post.php',
            data: { post_id: postId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert('Post liked successfully');
                    // Optionally update the like button or count here
                } else {
                    console.error("Error liking post:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while liking the post:", error);
            }
        });
    }
    
    


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


    // Fetching user's posts
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: 'fetch_user_posts.php',
            data: { user_email: "<?php echo $_SESSION['email']; ?>" },
            dataType: 'json',
            success: function(response) {
                response.forEach(function(post) {
                    var isLiked = post.is_liked_by_user > 0;
                    var likeClass = isLiked ? 'bxs-like liked' : 'bx-like';
                    var likeColor = isLiked ? '#0866ff' : '';
    
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
                            <div class="ComLikeCount">
                                <div class="reaction_count">
                                    <div>
                                        <img src="Assets/fb-like.png" alt="DP">
                                        <img src="Assets/fb-heart.png" alt="DP">
                                        <img src="Assets/fb-wow.png" alt="DP">
                                    </div>
                                    <p>
                                        100 Likes
                                    </p>
                                </div>
                                <div class="comshare_container">
                                    <p onclick="popupCommentModal(${post.id})">
                                        100 Comments
                                    </p>
                                    <p>
                                        1K shares
                                    </p>
                                </div>
                            </div>
                            <div class="usrsP_activities">
                                <div class="usrsP_ like" id="likeIcon${post.id}" data-post-id="${post.id}">
                                     <i class='bx ${likeClass}' style='color: ${likeColor}'></i>
                                    <p>Like</p>
                                </div>
                                <div class="usrsP_ comment" onclick="popupCommentModal(${post.id})">
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
                                <form action="add_comment.php" class="commentForm" method="post">
                                    <input type="hidden" name="post_id" value="${post.id}">
                                    <input type="text" name="comment" placeholder="Comment as ${post.firstname} ${post.lastname}" required>
                                    <button type="submit" class="commentBtn"><i class="fa-regular fa-paper-plane"></i></button>
                                </form>
                                </div>
                            </div>
                        </div>`;
                    
                    $(".users_Followers").after(postHtml);
                    
                    // Add event listener to like icon
                    $(`#likeIcon${post.id}`).on('click', function() {
                        likePost(post.id, $(this).find('i'));
                    });
                });

                // Submit comment form
                $(document).on('submit', '.commentForm', function(event) {
                    event.preventDefault(); 
                    var formData = $(this).serialize();
                    var commentForm = $(this);
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert("Comment posted successfully");
                                console.log('Comment added successfully');
                            } else {
                                console.error('Failed to add comment');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("An error occurred while adding comment.");
                        },
                        complete: function() {
                            commentForm[0].reset();
                        }
                    });
                });                                        
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching user's posts.");
            }
        });
    });



    // Fetching the posts of every followed accounts
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: 'fetch_following_posts.php',
            dataType: 'json',
            success: function(response) {
                response.forEach(function(post) {
                    var isLiked = post.is_liked_by_user > 0;
                    var likeClass = isLiked ? 'bxs-like liked' : 'bx-like';
                    var likeColor = isLiked ? '#0866ff' : '';
    
                    var postHtml = `
                        <div class="users_Posts">
                            <div class="usrsP_1">
                                <div class="usrsp1left">
                                    <div class="usrsp1left_01">
                                        <img src="${post.user_profile_picture}" alt="Profile">
                                    </div>
                                    <div class="usrsp1left_02">
                                        <p>${post.user_firstname} ${post.user_lastname}</p>
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
                            <div class="ComLikeCount">
                                <div class="reaction_count">
                                    <div>
                                        <img src="Assets/fb-like.png" alt="DP">
                                        <img src="Assets/fb-heart.png" alt="DP">
                                        <img src="Assets/fb-wow.png" alt="DP">
                                    </div>
                                    <p>
                                        100 Likes
                                    </p>
                                </div>
                                <div class="comshare_container">
                                    <p onclick="popupCommentModal(${post.id})">
                                        100 Comments
                                    </p>
                                    <p>
                                        1K shares
                                    </p>
                                </div>
                            </div>
                            <div class="usrsP_activities">
                                <div class="usrsP_ like" id="likeIcon${post.id}" data-post-id="${post.id}">
                                    <i class='bx ${likeClass}' style='color: ${likeColor}'></i>
                                    <p>Like</p>
                                </div>
                                <div class="usrsP_ comment" id="openCommentModal" onclick="popupCommentModal(${post.id})">
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
                                    <img src="${post.session_profile_picture}" alt="Profile Image">
                                </div>
                                <div class="usrspcomR">
                                    <form action="add_comment.php" class="commentForm" method="post">
                                        <input type="hidden" name="post_id" required value="${post.id}">
                                        <input type="text" name="comment" placeholder="Comment as ${post.session_firstname} ${post.session_lastname}" required>
                                        <button type="submit" class="commentBtn"><i class="fa-regular fa-paper-plane"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>`;
                    $(".users_Followers").after(postHtml);

                    // Add event listener to like icon
                    $(`#likeIcon${post.id}`).on('click', function() {
                        likePost(post.id, $(this).find('i'));
                    });
                });

            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching user's posts.");
            }
        });
    });

    function likePost(postId, icon) {
        $.ajax({
            type: 'POST',
            url: 'like_post.php',
            data: { post_id: postId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    icon.removeClass('bx-like').addClass('bxs-like').css('color', '#0866ff');
                } else {
                    console.error("Error liking post:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while liking the post:", error);
            }
        });
    }
    
    
    
    
    

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


});



function getTimeAgo(timestamp) {
    const now = new Date();
    const notificationTime = new Date(timestamp);
    const diff = now - notificationTime;
    const diffInMinutes = Math.floor(diff / (1000 * 60));
    const diffInHours = Math.floor(diff / (1000 * 60 * 60));
    const diffInDays = Math.floor(diff / (1000 * 60 * 60 * 24));
    const diffInWeeks = Math.floor(diff / (1000 * 60 * 60 * 24 * 7));
    const diffInMonths = Math.floor(diff / (1000 * 60 * 60 * 24 * 30));

    if (diffInMinutes < 1) {
        return 'just now';
    } else if (diffInMinutes === 1) {
        return '1 minute ago';
    } else if (diffInMinutes < 60) {
        return `${diffInMinutes} minutes ago`;
    } else if (diffInHours === 1) {
        return '1 hour ago';
    } else if (diffInHours < 24) {
        return `${diffInHours} hours ago`;
    } else if (diffInDays === 1) {
        return '1 day ago';
    } else if (diffInDays < 7) {
        return `${diffInDays} days ago`;
    } else if (diffInWeeks === 1) {
        return '1 week ago';
    } else if (diffInWeeks < 4) {
        return `${diffInWeeks} weeks ago`;
    } else if (diffInMonths === 1) {
        return '1 month ago';
    } else {
        return `${diffInMonths} months ago`;
    }
}

$(document).ready(function() {
    function fetchNotifications() {
        $.ajax({
            type: 'GET',
            url: 'fetch_notifications.php',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const notifications = response.notifications;
                    let notificationsHtml = '';

                    notifications.forEach(notification => {
                        const timeAgo = getTimeAgo(notification.notification_time);
                        notificationsHtml += `
                            <div class="user_Reaction_Comments">
                                <div class="urc_right">
                                    <img src="${notification.liker_profile_picture}" alt="DP">
                                </div>
                                <div class="urc_left">
                                    <div class="ul_up">
                                        <p><strong>${notification.liker_firstname} ${notification.liker_lastname}</strong><br> ${notification.message}</p>
                                    </div>
                                    <div class="ul_down">
                                        ${timeAgo}
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    $('#notificationsList').html(notificationsHtml);
                } else {
                    console.error('Failed to fetch notifications:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('An error occurred while fetching notifications:', error);
            }
        });
    }

    fetchNotifications();
    setInterval(fetchNotifications, 60000);
});
