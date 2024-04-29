document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.style.display = 'none';
    document.body.appendChild(fileInput);

    const fileInputTrigger = document.getElementById('fileInputTrigger');
    fileInputTrigger.addEventListener('click', function() {
        fileInput.click();
        console.log("File input clicked"); 
    });

    fileInput.addEventListener('change', function(event) {
        const chosenImage = document.getElementById('chosenImage');
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                chosenImage.src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });

    // Code for posting
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission behavior

        const textarea = form.querySelector('textarea[name="post_text"]');
        const chosenImage = document.getElementById('chosenImage');
        const caption = textarea.value.trim();
        const imageData = chosenImage.src;

        // Check if either text or image is provided
        if (caption || imageData) {
            // Send AJAX request to post.php
            $.ajax({
                type: 'POST',
                url: 'post.php',
                data: { caption: caption, imageData: imageData },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message); // Show success message
                        // Clear form fields or reset form
                        form.reset(); // Reset form
                        chosenImage.src = ''; // Clear image preview
                    } else {
                        alert(response.message); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('An error occurred while posting.');
                }
            });
        } else {
            alert('Please provide text, an image, or both.'); // Provide feedback to user
        }
    });
});
