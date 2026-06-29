# Correction citation MVC - jointure dans le model

Cette version n'utilise pas de table de jointure.

Relation utilisée :

```sql
user_humeur.id_citation -> citation.id
```

La citation est choisie aléatoirement quand l'utilisateur enregistre une humeur avec une note.
Ensuite elle reste stockée dans `user_humeur.id_citation`, donc elle ne change pas au rechargement de l'accueil.
Elle change seulement au prochain enregistrement d'une humeur.

À importer dans phpMyAdmin si besoin :

```text
correction_citation_mvc.sql
```

Le code essaie aussi de créer automatiquement `user_humeur.id_citation` si la colonne manque.
