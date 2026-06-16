function applySavedTheme() {
    const theme = localStorage.getItem("theme");
    if (theme) {
        document.body.className = theme;
    }
}

document.addEventListener("DOMContentLoaded", applySavedTheme);
