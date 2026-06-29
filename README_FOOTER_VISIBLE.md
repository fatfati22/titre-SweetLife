# Correction footer visible

Le footer était caché par `display: none` en mobile et il n'était pas inclus dans le layout d'authentification.

Corrections :
- footer visible sur mobile et desktop ;
- effet glass conservé ;
- espace ajouté en mobile pour ne pas passer derrière la navbar du bas ;
- footer ajouté aussi aux pages connexion/inscription via `vue/layout/auth.php`.
