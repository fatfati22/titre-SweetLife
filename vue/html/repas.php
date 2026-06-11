<?php
// Vue repas — contenu uniquement
?>
<!-- FILTERS -->
        <input type="radio" name="type" id="all" checked />
        <input type="radio" name="type" id="entree" />
        <input type="radio" name="type" id="plat-principale" />
        <input type="radio" name="type" id="dessert-fruit" />
        <input type="radio" name="type" id="snack" />

<article class="mood-card glass-card">
                <p>💫 État émotionnel actuel</p>

                <section class="affichage-humeur">
                    <span class="big-emoji" id="moodEmoji">😌</span>
                    <h3>Calme & Sereine</h3>
                </section>
            </article>

            <h1>🥗 Repas</h1>
            <p class="sous-titre">Des repas adaptés à ton humeur.</p>

            <section class="banniere">
                <span>🌸</span>
                <div>
                    <h3>Repas recommandés</h3>
                    <p>Des plats équilibrés pour ton bien-être.</p>
                </div>
            </section>

            <!-- FILTER BUTTONS -->
            <section class="filtres">
                <label for="all">🌿 Tous</label>
                <label for="entree">☀️ Entrée</label>
                <label for="plat-principale">🌤 Plat principal</label>
                <label for="dessert-fruit">🌙 Dessert / Fruit</label>
                <label for="snack">🫐 Snack</label>
            </section>

            <!-- GRID -->
            <section class="grille">
                <article data-type="entree">
                    <img
                        src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?w=600"
                    />

                    <div class="contenu">
                        <h2>Granola Soleil</h2>
                        <p>Granola maison et fruits frais.</p>

                        <div class="etiquettes">
                            <span>☀️ Matin</span>
                            <span>Vegan</span>
                        </div>

                        <div class="statistiques">
                            <div><strong>320</strong><small>KCAL</small></div>
                            <div><strong>12g</strong><small>PROT</small></div>
                        </div>

                        <button>Ajouter</button>
                    </div>
                </article>

                <article data-type="plat-principale">
                    <img
                        src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600"
                    />

                    <div class="contenu">
                        <h2>Salade Arc-en-Ciel</h2>
                        <p>Riche en antioxydants.</p>

                        <div class="etiquettes">
                            <span>🌤 Déjeuner</span>
                        </div>

                        <div class="statistiques">
                            <div><strong>280</strong><small>KCAL</small></div>
                            <div><strong>9g</strong><small>PROT</small></div>
                        </div>

                        <button>Ajouter</button>
                    </div>
                </article>

                <article data-type="dessert-fruit">
                    <img
                        src="https://images.unsplash.com/photo-1547592166-23ac45744acd?w=600"
                    />

                    <div class="contenu">
                        <h2>Soupe Curcuma</h2>
                        <p>Apaisante et réconfortante.</p>

                        <div class="etiquettes">
                            <span>🌙 Dîner</span>
                        </div>

                        <div class="statistiques">
                            <div><strong>210</strong><small>KCAL</small></div>
                            <div><strong>5g</strong><small>PROT</small></div>
                        </div>

                        <button>Ajouter</button>
                    </div>
                </article>
            </section>
