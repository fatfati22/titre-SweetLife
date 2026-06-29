# Repas et exercices selon la dernière humeur

Cette correction fait que les pages **Repas** et **Exercices** affichent automatiquement les contenus liés à la dernière humeur enregistrée par l'utilisateur.

## Fonctionnement

1. L'utilisateur choisit une humeur sur l'accueil.
2. Il enregistre sa note.
3. Le site ajoute une ligne dans `user_humeur`.
4. Les pages Repas et Exercices récupèrent la dernière ligne de `user_humeur` pour cet utilisateur.
5. Les repas/exercices affichés sont filtrés avec `id_humeur`.

## Fichiers modifiés

- `controller/repasController.php`
- `controller/exerciceController.php`
- `model/traitrepas.php`
- `model/traitExercice.php`
- `vue/html/repas.php`
- `vue/html/exercice.php`

## Requête SQL importante

Les tables `repas` et `exercice` doivent avoir une colonne `id_humeur` reliée à la table `humeur`.

Exemple :

```sql
SELECT * FROM repas WHERE id_humeur = 5;
SELECT * FROM exercice WHERE id_humeur = 5;
```

## Correction ajoutée : État émotionnel actuel automatique

Le fichier `vue/html/actuel.php` affiche maintenant automatiquement la dernière humeur enregistrée par l'utilisateur.

Avant, le bloc affichait toujours :

```text
😌 Calme & Sereine
```

Maintenant, il affiche :

- l'icône de la dernière humeur choisie ;
- le nom de la dernière humeur ;
- un message si aucune humeur n'a encore été enregistrée.

Ce bloc est utilisé dans les pages Repas et Exercices.
