# Correction message Choisir mon humeur au clic

Correction de la page d'accueil :

- le message sous `🌸 Choisir mon humeur` n'est plus affiché directement ;
- il apparaît seulement quand l'utilisateur clique sur le bouton ;
- si l'utilisateur est déconnecté, le message affiche :
  `Connecte-toi pour choisir ton humeur et ouvrir la note.`
- si l'utilisateur est connecté, le message affiche :
  `Clique dans les icônes en cercle à droite pour choisir ton humeur.`
- le clic fait aussi défiler doucement vers le cercle des humeurs.

Fichiers modifiés :

- `vue/html/index.php`
- `vue/layout/main.php`
- `vue/css/style.css`
- `vue/js/choisirHumeurMessage.js`
