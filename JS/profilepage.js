
document.addEventListener("DOMTContentLoaded", function() {
    const fbcDiv = document.getElementById("FBC");
    const homeIcon = document.getElementById("homeIcon");

    fbcDiv.addEventListener("mouseover", function() {
        homeIcon.style.color = "#0866ff";
    });

    fbcDiv.addEventListener("mouseout", function() {
        homeIcon.style.color = "#949596";
    });
})

function goToMainPage() {
    if (confirm("Unable to post here, go to mainpage instead?")) {
        window.location.href = "mainpage.php";
    } else {
    }
}



// JavaScript to handle uploading profile picture
document.addEventListener("DOMContentLoaded", function() {
    const cameraIcon = document.getElementById('cameraIcon');
    const profilePictureInput = document.getElementById('profilePictureInput');

    if (cameraIcon && profilePictureInput) {
        cameraIcon.addEventListener('click', function() {
            profilePictureInput.click();
        });

        profilePictureInput.addEventListener('change', function(event) {
            const profilePicturePreview = document.getElementById('profilePicture');
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicturePreview.src = e.target.result;
                }
                reader.readAsDataURL(event.target.files[0]);
                
                const confirmUpload = confirm("Do you want to upload this image as your profile picture?");
                if (confirmUpload) {
                    const formData = new FormData();
                    formData.append('profilePicture', event.target.files[0]);

                    $.ajax({
                        type: 'POST',
                        url: 'upload_profile_picture.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message); 
                            } else {
                                alert(response.message); 
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('An error occurred while uploading profile picture.');
                        }
                    });
                }
            } else {
                console.error('No image file selected');
            }
        });
    } else {
        console.error('Camera icon or profile picture input not found');
    }
});