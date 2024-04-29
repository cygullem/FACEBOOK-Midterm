document.addEventListener("DOMContentLoaded", function() {
    const imageInput = document.getElementById('imageInput');
    const form = document.querySelector('form');
    const fileInputTrigger = document.getElementById('fileInputTrigger');

    imageInput.addEventListener('change', function(event) {
        const chosenImage = document.getElementById('chosenImage');
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                chosenImage.src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        } else {
            console.error('No image file selected');
        }
    });

    fileInputTrigger.addEventListener('click', function() {
        imageInput.click();
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        handleFormSubmission();
    });
});

function handleFormSubmission() {
    const form = document.querySelector('form');
    const caption = form.querySelector('textarea').value.trim();
    const image = document.getElementById('imageInput').files[0]; 

    if (caption || image) {
        const formData = new FormData();
        formData.append('caption', caption);
        formData.append('image', image);

        console.log("Sending AJAX request...");
        $.ajax({
            type: 'POST',
            url: 'post.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = 'mainpage.php'; 
                } else {
                    alert(response.message); 
                }
            },                               
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while posting.');
            }
        });
    } else {
        alert('Please provide text, an image, or both.');
    }
}
