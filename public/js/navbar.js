function showDropdown() {
    var dropdown = document.getElementById("dropdown");
    var userProfile = document.getElementById("userProfile");
    userProfile.classList.add("move-userProfileDropdown");
    dropdown.classList.remove("hidden");
}

function hideDropdown() {
    var dropdown = document.getElementById("dropdown");
    var userProfile = document.getElementById("userProfile");
    dropdown.classList.add("hidden");
    userProfile.classList.remove("move-userProfileDropdown");
}
