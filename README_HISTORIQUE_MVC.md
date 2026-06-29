# Historique en MVC

La page historique est maintenant séparée en MVC :

- `model/traitHistorique.php` : requêtes MySQLi pour récupérer les humeurs de l'utilisateur.
- `controller/historiqueController.php` : récupère l'utilisateur connecté, gère les filtres et prépare les variables pour la vue.
- `vue/html/historique.php` : affiche les filtres, les statistiques et les cartes.
- `vue/css/historique.css` : style des cartes et du layout.
- `vue/js/historique.js` : ouverture/fermeture des menus de mois.

Les cartes affichent automatiquement :

- l'icône de l'humeur ;
- le nom de l'humeur ;
- la date ;
- la note associée si elle a été enregistrée au même moment ;
- les couleurs `couleur_haut` et `couleur_bas` venant de SQL.

Filtres disponibles :

- Tout l'historique ;
- Dernières 24h ;
- Par année et par mois.
