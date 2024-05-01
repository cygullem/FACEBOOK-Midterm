
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