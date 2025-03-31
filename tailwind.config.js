import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],

    theme: {
        extend: {
            keyframes: {
                blink: {
                    "0%": { opacity: "1" },
                    "50%": { opacity: "0.5" },
                    "100%": { opacity: "1" },
                },
            },
            animation: {
                blink: "blink 5s linear infinite",
            },
            colors: {
                ostrov: "#305582",
                ostrovHover: "#305582b8",
                primaryAction: "#49FF00", //new
                // primaryAction: "#38e1af", //old
                color1: "#A30000",
                color1Hover: "#7A0000",
                color2: "#8B008B",
                color2Hover: "#FFFFFF",
            },
        },
    },

    plugins: [forms],
};
