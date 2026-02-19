const hamburger = document.getElementById("hamburger");
const content = document.getElementById("content");
const hamburgerOpen = document.getElementById("hamburger-open");
const hamburgerClose = document.getElementById("hamburger-close");
const mainNavBar = document.getElementById("mainNavBar2");

if (hamburger) {
    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("is-active");
        if (hamburger.classList.contains("is-active")) {
            hamburgerOpen.classList.add("hidden");
            hamburgerClose.classList.add("block");
            hamburgerClose.classList.remove("hidden");
            hamburgerOpen.classList.remove("block");
        } else {
            hamburgerOpen.classList.add("block");
            hamburgerClose.classList.add("hidden");
            hamburgerClose.classList.remove("block");
            hamburgerOpen.classList.remove("hidden");
        }
        mainNavBar.classList.toggle("hidden");
        mainNavBar.classList.toggle("colnav");
    });
}
