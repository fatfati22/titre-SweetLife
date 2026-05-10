const emojiEl = document.getElementById("moodEmoji");

let y = 0;
let direction = 1;

function animate() {
    y += 0.2 * direction;

    if (y > 10 || y < -10) {
        direction *= -1;
    }

    emojiEl.style.transform = `translateY(${y}px)`;
    requestAnimationFrame(animate);
}

animate();

emojiEl.addEventListener("click", () => {
    emojiEl.style.transform = "scale(1.4) rotate(10deg)";

    setTimeout(() => {
        emojiEl.style.transform = `translateY(${y}px) scale(1)`;
    }, 200);
});
