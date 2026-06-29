        <h1 class="admin-title">🎨 Couleurs & Thèmes</h1>

        <div class="admin-form-card glass-card">
            <h3>Thèmes disponibles dans l'application</h3>
            <p class="theme-intro">Ces thèmes sont automatiquement appliqués selon l'humeur sélectionnée par
                l'utilisateur. Chaque classe CSS correspond à une humeur dans la base de données.</p>

            <div class="themes-grid">

                <div class="theme-demo-card glass-card theme-calme">
                    <div class="theme-demo-header">
                        <span>😌</span>
                        <strong>theme-calme</strong>
                    </div>
                    <p>Fond vert doux – Texte #0d2520</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#e8f5f0"></div>
                        <div style="background:#a8d8c0"></div>
                        <div style="background:#5aaa8a"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #e8f5f0, #a8d8c0, #5aaa8a)</code>
                </div>

                <div class="theme-demo-card glass-card theme-joie">
                    <div class="theme-demo-header">
                        <span>😄</span>
                        <strong>theme-joie</strong>
                    </div>
                    <p>Fond jaune-orange – Texte #2d2000</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#fff9e6"></div>
                        <div style="background:#ffe066"></div>
                        <div style="background:#ffb347"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #fff9e6, #ffe066, #ffb347)</code>
                </div>

                <div class="theme-demo-card glass-card theme-tristesse">
                    <div class="theme-demo-header">
                        <span>😢</span>
                        <strong>theme-tristesse</strong>
                    </div>
                    <p>Fond bleu doux – Texte #1a2535</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#e8ecf0"></div>
                        <div style="background:#b8cde0"></div>
                        <div style="background:#7096b8"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #e8ecf0, #b8cde0, #7096b8)</code>
                </div>

                <div class="theme-demo-card glass-card theme-colere">
                    <div class="theme-demo-header">
                        <span>😠</span>
                        <strong>theme-colere</strong>
                    </div>
                    <p>Fond rouge – Texte #2d0a0a</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#f5e8e8"></div>
                        <div style="background:#e8a0a0"></div>
                        <div style="background:#b22222"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #f5e8e8, #e8a0a0, #b22222)</code>
                </div>

                <div class="theme-demo-card glass-card theme-fatigue">
                    <div class="theme-demo-header">
                        <span>😴</span>
                        <strong>theme-fatigue</strong>
                    </div>
                    <p>Fond gris – Texte #222</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#eeeeee"></div>
                        <div style="background:#cccccc"></div>
                        <div style="background:#aaaaaa"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #eeeeee, #cccccc, #aaaaaa)</code>
                </div>

                <div class="theme-demo-card glass-card theme-stress">
                    <div class="theme-demo-header">
                        <span>😰</span>
                        <strong>theme-stress</strong>
                    </div>
                    <p>Fond bleu vif – Texte #0a1f44</p>
                    <div class="theme-demo-swatches">
                        <div style="background:#e0f0ff"></div>
                        <div style="background:#89c2ff"></div>
                        <div style="background:#3a86ff"></div>
                    </div>
                    <code>background: linear-gradient(135deg, #e0f0ff, #89c2ff, #3a86ff)</code>
                </div>

            </div>

            <div class="theme-info glass-card">
                <h4>📝 Pour ajouter un nouveau thème</h4>
                <ol>
                    <li>Ajoutez la classe dans <code>vue/css/theme.css</code> — ex :
                        <code>.theme-surprise { background: linear-gradient(…) }</code>
                    </li>
                    <li>Ajoutez les variantes de boutons dans <code>vue/css/element-theme.css</code></li>
                    <li>Créez ou modifiez une humeur (onglet Humeurs) avec la valeur <code>theme-surprise</code> dans le
                        champ <em>Couleur</em></li>
                </ol>
            </div>
        </div>
