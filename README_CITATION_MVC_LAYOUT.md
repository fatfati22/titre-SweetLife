# Citation MVC - SweetLife

## Objectif

La citation doit être choisie aléatoirement quand l'utilisateur choisit une humeur et enregistre une note.
Ensuite elle reste la même sur la page d'accueil jusqu'au prochain changement d'humeur.

## Structure MVC ajoutée

```text
model/traitCitation.php
controller/citationController.php
vue/html/citationAccueil.php
vue/css/citation.css
correction_citation_mvc.sql
```

## Fonctionnement

1. L'utilisateur clique sur une humeur.
2. Il écrit une note.
3. Au moment de l'enregistrement, `ajouterHumeurUtilisateur()` choisit une citation aléatoire selon `id_humeur`.
4. L'id de cette citation est enregistré dans `user_humeur.id_citation`.
5. L'accueil relit cette citation stockée. Elle ne change donc pas au refresh.
6. Elle change seulement au prochain changement d'humeur.

## Important

Importer dans phpMyAdmin :

```text
correction_citation_mvc.sql
```

Ce fichier ajoute la colonne :

```sql
user_humeur.id_citation
```

