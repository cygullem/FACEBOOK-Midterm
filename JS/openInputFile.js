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
});