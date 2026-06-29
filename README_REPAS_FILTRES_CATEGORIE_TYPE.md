# Correction repas : catégories + filtre type de repas

## Ce qui a été corrigé

La page `Repas` affiche toujours les repas liés à la dernière humeur enregistrée par l'utilisateur.

Les filtres ont été corrigés :

- filtre par catégorie ;
- filtre par type de repas ;
- possibilité de combiner les deux filtres ;
- message si aucun repas ne correspond aux filtres ;
- les filtres utilisent les `id` SQL au lieu des noms, donc les accents et espaces ne bloquent plus le filtrage.

## Fichiers modifiés

- `model/traitrepas.php`
- `vue/html/repas.php`
- `vue/css/filtre-repas.css`
- `vue/js/filtre.js`

## Pourquoi ça ne marchait pas avant

Avant, la carte utilisait le nom de la catégorie comme `data-type`, par exemple `Entrée` ou `Plat principal`, mais le CSS cherchait des valeurs comme `entree` ou `plat-principale`. Avec les accents, les majuscules et les espaces, le filtre ne pouvait pas fonctionner correctement.

Maintenant, le filtre utilise `data-category-id` et `data-type-id`, donc il correspond directement aux identifiants de MySQL.
