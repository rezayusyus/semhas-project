module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#4B5945", // Hijau
                background: "#faf1e3", // Krem
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
