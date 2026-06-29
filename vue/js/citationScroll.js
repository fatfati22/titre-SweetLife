document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const citationCard = document.getElementById('citation-apres-note');

    if (!citationCard || params.get('note') !== 'ok') {
        return;
    }

    citationCard.classList.add('citation-scroll-highlight');

    setTimeout(() => {
        citationCard.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }, 250);

    setTimeout(() => {
        citationCard.classList.remove('citation-scroll-highlight');
    }, 2600);
});
