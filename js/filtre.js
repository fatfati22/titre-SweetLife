document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".item");
    const radios = document.querySelectorAll('input[name="type"]');

    function filter(category) {
        items.forEach((item) => {
            if (category === "all") {
                item.style.display = "block";
            } else {
                item.style.display = item.classList.contains(category)
                    ? "block"
                    : "none";
            }
        });
    }

    radios.forEach((radio) => {
        radio.addEventListener("change", (e) => {
            filter(e.target.id);
        });
    });

    filter("all");
});
