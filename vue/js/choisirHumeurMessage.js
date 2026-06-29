document.addEventListener('DOMContentLoaded', () => {
    const btnChoisir = document.querySelector('.js-choisir-humeur');
    const message = document.getElementById('message-choisir-humeur');
    const moodWheel = document.getElementById('mood-wheel');

    if (!btnChoisir || !message) {
        return;
    }

    btnChoisir.addEventListener('click', (event) => {
        event.preventDefault();

        message.hidden = false;
        message.classList.add('is-visible');

        if (moodWheel) {
            moodWheel.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });
});
