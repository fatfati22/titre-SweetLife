# Correction humeur admin → accueil → note

Cette version permet aux nouvelles humeurs ajoutées dans l'admin de fonctionner automatiquement sur l'accueil.

Fonctionnement :

1. L'admin crée une humeur avec : nom, icône, couleur haut, couleur bas.
2. L'accueil lit directement toutes les humeurs depuis la table `humeur`.
3. Chaque bouton d'humeur reçoit automatiquement les `data-*` nécessaires : id, icône, thème, couleur haut, couleur bas.
4. Au clic, `theme.js` applique le thème SQL et ouvre la carte note.
5. La carte note affiche l'icône sélectionnée.
6. Le bouton Annuler restaure le thème précédent.

Fichiers principaux modifiés :

- `vue/html/afficheHumeur.php`
- `vue/js/theme.js`
- `vue/css/note.css`
- `controller/adminController.php`
- `vue/html/admin/humeurs.php`
