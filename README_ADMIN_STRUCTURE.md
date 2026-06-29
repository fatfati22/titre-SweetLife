# Organisation de la page admin

La page admin est maintenant séparée en plusieurs fichiers pour mieux comprendre le code.

## Vue principale
- `vue/html/admin.php` : fichier principal qui charge la bonne section.

## Sections séparées
- `vue/html/admin/sidebar.php` : menu gauche admin.
- `vue/html/admin/dashboard.php` : tableau de bord.
- `vue/html/admin/humeurs.php` : gestion des humeurs, thèmes et couleurs SQL.
- `vue/html/admin/repas.php` : gestion des repas.
- `vue/html/admin/exercices.php` : gestion des exercices.
- `vue/html/admin/utilisateurs.php` : gestion des utilisateurs.
- `vue/html/admin/themes.php` : aperçu des thèmes.

## JavaScript admin
- `vue/js/admin.js` : fonctions JS utilisées dans l'admin, par exemple les couleurs rapides.

## Correction du décalage
La correction du décalage admin/navbar est dans :
- `vue/css/admin.css`

La page admin utilise :
```php
$mainClass = 'admin-main';
```
Dans `controller/adminController.php`.
