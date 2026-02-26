document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('lang-dropdown');
    const dropdownMobile = document.getElementById('lang-dropdown-mobile');

    if (dropdown) {
        const wrapper = dropdown.parentElement;

        if (!wrapper.contains(e.target)) {
            dropdown.classList.add('hidden');
            dropdown.classList.remove('flex');
        }
    }

    if (dropdownMobile) {
        const wrapperMobile = dropdownMobile.parentElement;

        if (!wrapperMobile.contains(e.target)) {
            dropdownMobile.classList.add('hidden');
            dropdownMobile.classList.remove('flex');
        }
    }
});

window.showDropdown = function (id) {
    var dropdown = document.getElementById(id);
    dropdown.classList.remove("hidden");
}

window.hideDropdown = function (id) {
    var dropdown = document.getElementById(id);
    dropdown.classList.add("hidden");
}

window.toggleDropdown = function (id) {
    var dropdown = document.getElementById(id);
    if (dropdown.classList.contains("hidden")) {
        dropdown.classList.remove("hidden");
        dropdown.classList.add("flex");
    } else {
        dropdown.classList.add("hidden");
        dropdown.classList.remove("flex");
    }
}

const navbar = document.getElementById("mainNav");
let dropdown = document.getElementById("dropdown");


if (navbar && dropdown) {
    dropdown = dropdown.parentElement;
    dropdown.style.top = `${navbar.offsetHeight}px`;
}