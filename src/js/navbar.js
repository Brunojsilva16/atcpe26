$(document).ready(function () {
    // Function to handle the navbar affix effect
    function checkScroll() {
        // Check if the scroll position is greater than 50 pixels
        if ($(document).scrollTop() > 50) {
            // Add the 'affix' class to the mainNavbar
            $('#mainNavbar').addClass('affix');
        } else {
            // Remove the 'affix' class from the mainNavbar
            $('#mainNavbar').removeClass('affix');
        }
    }

    // Call the function once on page load to set the initial state
    checkScroll();

    // Attach the function to the window's scroll event
    $(window).scroll(function () {
        checkScroll();
    });
});