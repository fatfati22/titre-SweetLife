        <h1 class="admin-title">📊 Tableau de bord</h1>

        <div class="stats-grid">
            <div class="stat-card glass-card">
                <span class="stat-icon">👥</span>
                <div>
                    <p class="stat-val"><?= $stats['user'] ?></p>
                    <p class="stat-label">Utilisateurs</p>
                </div>
            </div>
            <div class="stat-card glass-card">
                <span class="stat-icon">😊</span>
                <div>
                    <p class="stat-val"><?= $stats['humeur'] ?></p>
                    <p class="stat-label">Humeurs</p>
                </div>
            </div>
            <div class="stat-card glass-card">
                <span class="stat-icon">🥗</span>
                <div>
                    <p class="stat-val"><?= $stats['repas'] ?></p>
                    <p class="stat-label">Repas</p>
                </div>
            </div>
            <div class="stat-card glass-card">
                <span class="stat-icon">🧘</span>
                <div>
                    <p class="stat-val"><?= $stats['exercice'] ?></p>
                    <p class="stat-label">Exercices</p>
                </div>
            </div>
            <div class="stat-card glass-card">
                <span class="stat-icon">💬</span>
                <div>
                    <p class="stat-val"><?= $stats['citation'] ?></p>
                    <p class="stat-label">Citations</p>
                </div>
            </div>
        </div>

        <div class="admin-shortcuts glass-card">
            <h3>Raccourcis rapides</h3>
            <div class="shortcut-grid">
                <a href="/index.php?route=admin&section=humeurs&action=new" class="shortcut-btn">➕ Nouvelle humeur</a>
                <a href="/index.php?route=admin&section=repas&action=new" class="shortcut-btn">➕ Nouveau repas</a>
                <a href="/index.php?route=admin&section=exercices&action=new" class="shortcut-btn">➕ Nouvel exercice</a>
                <a href="/index.php?route=admin&section=utilisateurs" class="shortcut-btn">👥 Gérer les users</a>
            </div>
        </div>
