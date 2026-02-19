import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    
    darkMode: "class",
    theme: {
        extend: {
            keyframes: {
                blink: {
                    "0%": { opacity: "1" },
                    "50%": { opacity: "0.5" },
                    "100%": { opacity: "1" },
                },
                customPulse: {
                    "0%, 100%": { color: "#000000", scale: "1" },
                    "50%": { color: "#49FF00", scale: "1.1" },
                },
            },
            animation: {
                blink: "blink 5s linear infinite",
                customPulse: "customPulse 5s infinite",
            },
            colors: {
                ostrov: "#305582",
                ostrovHover: "#1d3146",
                primaryAction: "#49FF00",

                darkMode: {
                    background: {
                        950: "#121212",
                        900: "#181818",
                        800: "#1f1f1f",
                    },
                    text: "#E0E0E0",
                    primary: "#49FF00",
                    buttonBg: "#1d3146",
                },
            },
        },
    },

    plugins: [forms],
};
