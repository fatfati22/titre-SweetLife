<aside class="admin-sidebar glass-card">
    <div class="admin-logo">
        <span>⚙️</span>
        <strong>Panel Admin</strong>
    </div>

    <nav class="admin-nav">
        <a href="/index.php?route=admin&section=dashboard" class="admin-nav-item <?= $section === 'dashboard' ? 'actif' : '' ?>">📊 Dashboard</a>
        <a href="/index.php?route=admin&section=humeurs" class="admin-nav-item <?= $section === 'humeurs' ? 'actif' : '' ?>">😊 Humeurs</a>
        <a href="/index.php?route=admin&section=repas" class="admin-nav-item <?= $section === 'repas' ? 'actif' : '' ?>">🥗 Repas</a>
        <a href="/index.php?route=admin&section=exercices" class="admin-nav-item <?= $section === 'exercices' ? 'actif' : '' ?>">🧘 Exercices</a>
        <a href="/index.php?route=admin&section=utilisateurs" class="admin-nav-item <?= $section === 'utilisateurs' ? 'actif' : '' ?>">👥 Utilisateurs</a>
        <a href="/index.php?route=admin&section=themes" class="admin-nav-item <?= $section === 'themes' ? 'actif' : '' ?>">🎨 Couleurs & Thèmes</a>
    </nav>

    <a href="/index.php?route=accueil" class="admin-back-btn">← Retour au site</a>
</aside>
