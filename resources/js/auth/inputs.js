document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(
        'input[type="text"], input[type="email"], input[type="password"]'
    );

    inputs.forEach((input) => {
        if (input.value.trim() !== "") {
            input.classList.add("has-value");
            input.classList.add("show-passEye");
        }
    });
});

let passwordVisibility = {
    password: false,
    password_confirmation: false,
};
function handleInputChange(id) {
    var inputElement = document.getElementById(id);
    if (inputElement.value.trim() !== "") {
        inputElement.classList.add("has-value");
        if (
            inputElement.id === "password" ||
            inputElement.id === "password_confirmation"
        ) {
            inputElement.type = passwordVisibility[id] ? "text" : "password";
            const inputWrapper = inputElement.parentNode;
            const inputSpan = inputWrapper.querySelector(".inputSpan");
            inputSpan.classList.add("show-passEye");
            inputSpan.classList.add("cursor-pointer");
            inputSpan.classList.remove("pointer-events-none");
            const inputSvg = inputSpan.querySelector("svg");
            inputSvg.classList.add("text-black");
            inputSvg.classList.add("dark:text-darkMode-text");
            var svgPath = inputSvg.querySelector("path");
            // Eye Open
            svgPath.setAttribute(
                "d",
                passwordVisibility[id]
                    ? "M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                    : "M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
            );
            inputSpan.removeEventListener(
                "click",
                togglePasswordVisibilityHandler
            );
            inputSpan.addEventListener(
                "click",
                togglePasswordVisibilityHandler
            );
        }
    } else {
        inputElement.classList.remove("has-value");
        if (
            inputElement.id === "password" ||
            inputElement.id === "password_confirmation"
        ) {
            const inputWrapper = inputElement.parentNode;
            const inputSpan = inputWrapper.querySelector(".inputSpan");
            inputSpan.classList.remove("show-passEye");
            inputSpan.classList.remove("cursor-pointer");
            inputSpan.classList.add("pointer-events-none");
            const inputSvg = inputSpan.querySelector("svg");
            inputSvg.classList.remove("text-black");
            inputSvg.classList.remove("dark:text-darkMode-text");
            var svgPath = inputSvg.querySelector("path");
            // Eye Open
            svgPath.setAttribute(
                "d",
                "M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
            );
            inputSpan.removeEventListener(
                "click",
                togglePasswordVisibilityHandler
            );
        }
    }
}

function togglePasswordVisibilityHandler(event) {
    const id = event.currentTarget.parentNode.querySelector("input").id;
    togglePasswordVisibility(id);
}

function togglePasswordVisibility(id) {
    passwordVisibility[id] = !passwordVisibility[id];
    const inputElement = document.getElementById(id);
    const svgPath = inputElement.parentNode.querySelector(
        ".inputSpan svg path"
    );
    if (passwordVisibility[id]) {
        inputElement.type = "text";
        svgPath.setAttribute(
            "d",
            "M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
        );
    } else {
        inputElement.type = "password";
        svgPath.setAttribute(
            "d",
            "M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
        );
    }
}

window.handleInputChange = handleInputChange;
