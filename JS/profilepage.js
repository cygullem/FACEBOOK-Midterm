
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