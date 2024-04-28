function search(e) {
    const form = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchField");
    if (searchInput.value === "") {
        e.preventDefault();
    } else {
        form.submit();
    }
}

document.addEventListener("DOMContentLoaded", function (event) {

    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    console.log(type);
    if (type === 'visit') {
        toggleContent('visit');
    }
    if (type === 'tech') {
        toggleContent('tech');
    }
});

function toggleContent(type) {
    var toggleId = type + "Toggle";
    var content = document.getElementById(toggleId);
    var icon = document.getElementById(type + "I");
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('query');

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        icon.setAttribute("name", "caret-up-outline");
        fadeInElement(toggleId);
        if (type === 'visit') {
            document.getElementById('toggletech').style.display = "none";
        } else {
            document.getElementById('togglevisit').style.display = "none";
        }

        //If the content is hidden or not set to display, it shows the content, changes the icon to an upward caret, and fades in the content.
        // If the content is visible, it hides the content, changes the icon to a downward caret, and fades out the content.
    } else {
        content.style.display = "none";

        icon.setAttribute("name", "caret-down-outline");

        if (type === 'visit') {
            document.getElementById('toggletech').style.display = "block";
        } else {
            document.getElementById('togglevisit').style.display = "block";
        }
    }
}

// When the document is ready, check for errors and open the relevant toggle.

function fadeInElement(element) {
    const targetElement = typeof element === 'string' ? document.getElementById(element) : element;
    targetElement.style.opacity = 0;
    let opacity = 0.0;
    const timer = setInterval(() => {
        opacity += 0.05; //5%
        targetElement.style.opacity = opacity;

        if (opacity >= 1) {
            clearInterval(timer); // Stop timer when opacity reaches 1
        }
    }, 10); // Update opacity every 10 milliseconds

    //This function is responsible for fading in an element.
    // It receives an element parameter, which can be either the element itself or its ID.
    // It initializes the opacity of the target element to 0.
    // It increments the opacity gradually by 5% (0.05) every 10 milliseconds until it reaches 1, effectively fading in the element.
    // Once the opacity reaches 1, the interval timer is cleared to stop further updates.
}
