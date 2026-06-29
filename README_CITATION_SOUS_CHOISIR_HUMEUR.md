# Correction citation accueil

La carte citation s'affiche maintenant seulement si l'utilisateur a enregistré une humeur avec une note et qu'une citation est liée à cette dernière humeur.

Placement : sous les boutons :
- 🌸 Choisir mon humeur
- ⏰ J’ai oublié une émotion

Après validation de la note, la redirection `index.php?route=accueil&note=ok` déclenche :
- un scroll automatique vers la carte citation ;
- une petite animation d'apparition / glow.

Fichiers modifiés :
- `vue/html/index.php`
- `vue/html/citationAccueil.php`
- `vue/js/citationScroll.js`
- `vue/layout/main.php`
- `vue/css/citation.css`
- `vue/css/style.css`
