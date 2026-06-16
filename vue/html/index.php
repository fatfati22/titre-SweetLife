<!doctype html>
<html lang="fr" class="theme-calme">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Cormorant+Garamond&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="/vue/css/note.css" />
    <link rel="stylesheet" href="/vue/css/footer.css" />
    <link rel="stylesheet" href="/vue/css/element-theme.css" />
    <link rel="stylesheet" href="/vue/css/theme.css" />
    <link rel="stylesheet" href="/vue/css/position-cercle-emojis.css" />
    <link rel="stylesheet" href="/vue/css/theme-initial.css" />
    <link rel="stylesheet" href="/vue/css/navbar.css" />
    <link rel="stylesheet" href="/vue/css/style.css" />
</head>

<body class="theme-calme">

    <?php include(__DIR__ . '/navbar.php'); ?>

    <main>
        <section class="hero">
            <article class="hero-content">

                <img class="mobile-logo" src="/vue/image/logo.png" alt="logo" />

                <section class="centrer">
                    <h1>
                        Comment vas-tu aujourd'hui
                        <span class="couleur">
                            <?php if (isset($_SESSION['user'])): ?>
                                <?= $_SESSION['user']['prenom']; ?> <?= $_SESSION['user']['nom']; ?> !
                            <?php else: ?>
                                Invité !
                            <?php endif; ?>
                        </span>
                    </h1>

                    <p>Choisis ton humeur pour recevoir des recommandations.</p>

                    <div class="alig">
                        <button class="btn-primary marg">
                            🌸 Choisir mon humeur
                            <a href=".mood-wheel">ici</a>
                        </button>

                        <button class="btn-ghost">
                            <a href="oubli.html">😬 vous avez oublié de noter votre humeur</a>
                        </button>
                    </div>
                </section>

                <!-- MOOD WHEEL -->
                <?php if (isset($_SESSION['user'])) : ?>
                    <section class="mood-wheel">

                        <button class="mood-btn" onclick="setTheme('theme-joie')">😊</button>
                        <button class="mood-btn" onclick="setTheme('theme-tristesse')">😢</button>
                        <button class="mood-btn" onclick="setTheme('theme-colere')">😠</button>
                        <button class="mood-btn" onclick="setTheme('theme-fatigue')">😴</button>
                        <button class="mood-btn" onclick="setTheme('theme-calme')">😌</button>
                        <button class="mood-btn" onclick="setTheme('theme-stress')">😰</button>

                        <button class="mood-btn center">🌸</button>
                    </section>
                <?php else : ?>
                    <section class="mood-wheel">
                        <button class="mood-btn" disabled>😊 🔒</button>
                        <button class="mood-btn" disabled>😢 🔒</button>
                        <button class="mood-btn" disabled>😠 🔒</button>
                        <button class="mood-btn" disabled>😴 🔒</button>
                        <button class="mood-btn" disabled>😌 🔒</button>
                        <button class="mood-btn" disabled>😰 🔒</button>
                        <button class="mood-btn center" disabled>🌸🔒</button>
                    </section>
                <?php endif; ?>

            </article>
        </section>
    </main>

    <!-- MODAL -->
    <div id="modal-note" class="modal-overlay" onclick="fermerModal(event)">
        <?php include(__DIR__ . '/note.php'); ?>
    </div>

    <footer class="glass-card">
        <img src="/vue/image/logo.png" alt="logo footer" />
        <p>site Public</p>
        <p>Panel admin V3.SweetLife2025</p>
    </footer>

    <script>
        /* =========================
   TRANSITION FLUIDE
========================= */
        document.addEventListener('DOMContentLoaded', () => {
            document.body.style.transition = "background-color 0.4s ease, color 0.4s ease";

            const saved = localStorage.getItem('theme');
            if (saved) {
                document.body.className = saved;
            }
        });

        /* =========================
           DATA HUMEURS
        ========================= */
        const humeurs = {
            'theme-calme': {
                emoji: '😌',
                label: 'Calme',
                nom: 'calme',
                id: 1
            },
            'theme-joie': {
                emoji: '😊',
                label: 'Joyeux(se)',
                nom: 'joie',
                id: 2
            },
            'theme-tristesse': {
                emoji: '😢',
                label: 'Triste',
                nom: 'tristesse',
                id: 3
            },
            'theme-colere': {
                emoji: '😠',
                label: 'En colère',
                nom: 'colere',
                id: 4
            },
            'theme-fatigue': {
                emoji: '😴',
                label: 'Fatigué(e)',
                nom: 'fatigue',
                id: 5
            },
            'theme-stress': {
                emoji: '😰',
                label: 'Stressé(e)',
                nom: 'stress',
                id: 6
            },
        };

        let humeurCourante = null;
        let themePrecedent = null;

        /* =========================
           SET THEME
        ========================= */
        function setTheme(theme) {

            themePrecedent = document.body.className;

            document.body.className = theme;

            humeurCourante = humeurs[theme] || null;
            if (!humeurCourante) return;

            const h = humeurCourante;

            document.getElementById('modal-emoji').textContent = h.emoji;
            document.querySelector('#modal-carte h1.titre').textContent = 'Tu te sens : ' + h.label;

            document.getElementById('modal-textarea').value = '';
            document.getElementById('modal-compteur').textContent = '0/300';
            document.getElementById('modal-textarea').classList.remove('erreur');

            document.getElementById('modal-carte').className = 'modal-carte note-' + h.nom;

            document.getElementById('modal-note').classList.add('actif');

            localStorage.setItem('theme', theme);

            setTimeout(() => {
                document.getElementById('modal-textarea').focus();
            }, 280);
        }

        /* =========================
           ANNULER = RETOUR THEME
        ========================= */
        function annulerNote() {

            document.getElementById('modal-note').classList.remove('actif');

            if (themePrecedent) {
                document.body.className = themePrecedent;
                localStorage.setItem('theme', themePrecedent);
            }
        }

        /* =========================
           FERMER MODAL
        ========================= */
        function fermerModal(e) {
            if (e && e.target !== document.getElementById('modal-note')) return;
            document.getElementById('modal-note').classList.remove('actif');
        }

        /* =========================
           ENREGISTRER NOTE
        ========================= */
        function enregistrerNote() {

            const texte = document.getElementById('modal-textarea').value.trim();

            if (texte.length < 10) {
                const ta = document.getElementById('modal-textarea');
                ta.classList.add('erreur');
                setTimeout(() => ta.classList.remove('erreur'), 600);
                return;
            }

            const btn = document.getElementById('btn-enregistrer');
            btn.disabled = true;
            btn.textContent = 'Enregistrement…';

            const formData = new FormData();
            formData.append('ajouter', '1');
            formData.append('description', texte);

            if (humeurCourante) {
                formData.append('id_humeur', humeurCourante.id);
            }

            fetch('index.php?route=note', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {

                    if (response.ok) {

                        document.getElementById('modal-note').classList.remove('actif');

                        const notif = document.createElement('div');
                        notif.textContent = '✅ Note enregistrée !';
                        notif.style.cssText =
                            'position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:#4CAF50;color:#fff;padding:12px 24px;border-radius:12px;font-weight:bold;z-index:9999;box-shadow:0 4px 12px rgba(0,0,0,.2)';

                        document.body.appendChild(notif);
                        setTimeout(() => notif.remove(), 2500);

                    } else {
                        alert('Erreur lors de l\'enregistrement.');
                    }
                })
                .catch(() => alert('Erreur réseau.'))
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = 'Enregistrer 🔃';
                });
        }

        /* =========================
           COMPTEUR TEXTE
        ========================= */
        document.addEventListener('input', (e) => {
            if (e.target.id === 'modal-textarea') {
                document.getElementById('modal-compteur').textContent =
                    e.target.value.length + '/300';
            }
        });

        /* =========================
           ESC CLOSE
        ========================= */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.getElementById('modal-note').classList.remove('actif');
            }
        });
    </script>

</body>

</html>