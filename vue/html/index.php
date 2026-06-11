<!doctype html>
<html lang="fr" class="theme-calme">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife</title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Cormorant+Garamond&display=swap"
        rel="stylesheet" />
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
                <img
                    class="mobile-logo"
                    src="/vue/image/logo.png"
                    alt="le logo de site SweetLife" />
                <section class="centrer">
                    <h1>
                        Comment vas-tu
                        <span class="couleur">aujourd'hui <?php if (isset($_SESSION['user'])): ?>

                                <?php echo $_SESSION['user']['prenom']; ?>
                                <?php echo $_SESSION['user']['nom']; ?> !
                            <?php else: ?>
                                Invité!
                            <?php endif; ?> </span>
                    </h1>


                    <p>
                        Choisis ton humeur pour recevoir des
                        recommandations.
                    </p>

                    <div class="alig">
                        <button class="btn-primary marg">
                            🌸 Choisir mon humeur
                            <a href=".mood-wheel">ici</a>
                        </button>
                        <button class="btn-ghost">
                            <a href="oubli.html">
                                😬 vous avez oublier de noter votre
                                humeurs</a>
                        </button>
                    </div>
                </section>

                <!-- FLEUR -->
                <?php if (isset($_SESSION['user'])) : ?>

                    <section class="mood-wheel">
                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-joie')">
                            😊
                        </button>

                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-tristesse')">
                            😢
                        </button>

                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-colere')">
                            😠
                        </button>

                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-fatigue')">
                            😴
                        </button>

                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-calme')">
                            😌
                        </button>

                        <button
                            class="mood-btn"
                            onclick="setTheme('theme-stress')">
                            😰
                        </button>

                        <!-- CENTRE -->
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


                        <!-- CENTRE -->
                        <button class="mood-btn center" disabled>🌸🔒</button>
                    </section>

                <?php endif; ?>
            </article>
        </section>
    </main>

    <!-- MODAL NOTE D'HUMEUR -->
    <div id="modal-note" class="modal-overlay" onclick="fermerModal(event)">
        <div class="modal-carte" id="modal-carte">
            <div class="emotion" id="modal-emoji">😊</div>
            <h1 class="titre">Comment tu te sens ?</h1>
            <p class="texte-info">Ajoute une note sur ce qui se passe (10 caractères minimum)</p>
            <textarea
                class="zone-message"
                id="modal-textarea"
                placeholder="Que se passe-t-il en ce moment ?"
                maxlength="300"></textarea>
            <div class="compteur" id="modal-compteur">0/300</div>
            <div class="zone-boutons">
                <button class="bouton-annuler" onclick="fermerModal()">Annuler</button>
                <button class="bouton-enregistrer" id="btn-enregistrer" onclick="enregistrerNote()">Enregistrer 🔃</button>
            </div>
        </div>
    </div>

    <footer class="glass-card">
        <img src="/vue/image/logo.png" alt="logo footer" />
        <p>site Public</p>
        <p>Panel admin V3.SweetLife2025</p>
    </footer>

    <script>
        const humeurs = {
            'theme-calme': {
                emoji: '😌',
                label: 'Calme',
                nom: 'calme'
            },
            'theme-joie': {
                emoji: '😊',
                label: 'Joyeux(se)',
                nom: 'joie'
            },
            'theme-tristesse': {
                emoji: '😢',
                label: 'Triste',
                nom: 'tristesse'
            },
            'theme-colere': {
                emoji: '😠',
                label: 'En colère',
                nom: 'colere'
            },
            'theme-fatigue': {
                emoji: '😴',
                label: 'Fatigué(e)',
                nom: 'fatigue'
            },
            'theme-stress': {
                emoji: '😰',
                label: 'Stressé(e)',
                nom: 'stress'
            },
        };

        function setTheme(theme) {
            document.body.className = theme;

            const h = humeurs[theme];
            document.getElementById('modal-emoji').textContent = h.emoji;
            document.getElementById('modal-textarea').value = '';
            document.getElementById('modal-compteur').textContent = '0/300';
            document.getElementById('modal-textarea').classList.remove('erreur');

            // Changer la couleur de la carte selon l'humeur
            document.getElementById('modal-carte').className = 'modal-carte note-' + h.nom;

            document.getElementById('modal-note').classList.add('actif');
            setTimeout(() => document.getElementById('modal-textarea').focus(), 280);
        }

        function fermerModal(e) {
            if (e && e.target !== document.getElementById('modal-note')) return;
            document.getElementById('modal-note').classList.remove('actif');
        }

        function enregistrerNote() {
            const texte = document.getElementById('modal-textarea').value.trim();
            if (texte.length < 10) {
                const ta = document.getElementById('modal-textarea');
                ta.classList.add('erreur');
                setTimeout(() => ta.classList.remove('erreur'), 600);
                return;
            }
            // TODO : fetch('?route=humeur&action=noter', { method:'POST', ... })
            document.getElementById('modal-note').classList.remove('actif');
        }

        document.getElementById('modal-textarea').addEventListener('input', function() {
            document.getElementById('modal-compteur').textContent = this.value.length + '/300';
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') document.getElementById('modal-note').classList.remove('actif');
        });
    </script>
</body>

</html>