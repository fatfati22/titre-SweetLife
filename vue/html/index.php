<?php $utilisateurConnecte = isset($_SESSION['user']); ?>
<section class="hero">
    <article class="hero-content">

        <img class="mobile-logo" src="/vue/image/logo.png" alt="logo" />

        <section class="centrer">
            <h1 class="accueil-title">
                Comment vas-tu aujourd'hui
                <span class="couleur">
                    <?php if ($utilisateurConnecte): ?>
                    <?= htmlspecialchars($_SESSION['user']['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?> <?= htmlspecialchars($_SESSION['user']['nom'] ?? '', ENT_QUOTES, 'UTF-8'); ?> !
                    <?php else: ?>
                    Invité !
                    <?php endif; ?>
                </span>
            </h1>

            <p class="accueil-text">Choisis ton humeur pour recevoir des recommandations.</p>

            <div class="alig">
                <div class="mood-action-block">
                    <div class="mood-main-actions">
                        <a
                            class="btn-primary marg js-choisir-humeur"
                            href="#mood-wheel"
                            data-connecte="<?= $utilisateurConnecte ? '1' : '0' ?>"
                        >
                            🌸 Choisir mon humeur
                        </a>

                        <?php if ($utilisateurConnecte) : ?>
                            <a class="btn-oubli-humeur" href="index.php?route=oubli">
                                ⏰ J’ai oublié une émotion
                            </a>
                        <?php endif; ?>
                    </div>

                    <p
                        class="mood-info-message mood-info-message-under-title"
                        id="message-choisir-humeur"
                        hidden
                    >
                        <?php if ($utilisateurConnecte) : ?>
                            Clique dans les icônes en cercle à droite pour choisir ton humeur.
                        <?php else : ?>
                            Connecte-toi pour choisir ton humeur et ouvrir la note.
                        <?php endif; ?>
                    </p>

                    <?php require __DIR__ . '/citationAccueil.php'; ?>
                </div>

                <?php if (!$utilisateurConnecte) : ?>
                    <a class="btn-ghost" href="/index.php?route=connexion">
                        😬 Se connecter
                    </a>
                <?php endif; ?>
            </div>
        </section>

        <?php require_once __DIR__ . '/afficheHumeur.php'; ?>

        <?php if ($utilisateurConnecte) : ?>
            <div class="modal-overlay" id="modal-note" onclick="fermerModal(event)">
                <?php require __DIR__ . '/note.php'; ?>
            </div>
        <?php endif; ?>
    </article>
</section>
