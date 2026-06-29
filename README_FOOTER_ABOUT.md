# Footer moderne + pages informations

Corrections ajoutées :

- Footer moderne en glass effect sur toute la largeur.
- Footer caché en mobile avec `display: none` pour ne pas gêner la navbar mobile.
- Liens rapides : Accueil, Repas, Exercices, Historique, Profil.
- Liens informations : À propos, Contact, Mentions légales.
- Création des pages MVC :
  - `controller/aboutController.php`
  - `controller/contactController.php`
  - `controller/mentionsController.php`
  - `vue/html/about.php`
  - `vue/html/contact.php`
  - `vue/html/mentions.php`
  - `vue/css/about.css`
- Routes ajoutées dans `index.php` :
  - `index.php?route=about`
  - `index.php?route=contact`
  - `index.php?route=mentions`
