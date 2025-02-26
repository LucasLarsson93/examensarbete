document.addEventListener("DOMContentLoaded", function () {
    const myButton = document.getElementById("myBtn");

    // Add an event listener for when the user scrolls
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            myButton.style.display = "block";
        } else {
            myButton.style.display = "none";
        }
    }

    function topFunction() {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    }

    // Ensure the button exists and set its event listener
    if (myButton) {
        myButton.addEventListener("click", topFunction);
    }
});
