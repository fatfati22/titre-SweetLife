# Correction filtres repas glass effect

La page Repas utilise maintenant un vrai effet glass séparé pour les deux blocs :

- 📂 Catégorie
- 🍽️ Type de repas

Fichier modifié :

```text
vue/css/filtre-repas.css
```

Correction :

- le conteneur `.repas-filtres` ne met plus un grand bloc blanc/global ;
- chaque `.filtre-groupe` a son propre effet glass ;
- les boutons gardent le même design transparent/flou ;
- le responsive reste propre sur mobile.
