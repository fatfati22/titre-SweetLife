# Citation aléatoire sur l'accueil

Correction ajoutée :

- quand l'utilisateur clique sur une humeur et enregistre sa note, le site choisit une citation aléatoire liée à cette humeur ;
- la citation est enregistrée dans `user_humeur.id_citation` ;
- elle s'affiche sur la page d'accueil ;
- elle ne change pas au rechargement de la page ;
- elle change seulement quand l'utilisateur choisit une nouvelle humeur et enregistre une nouvelle note.

## Important

Importer dans phpMyAdmin :

```sql
correction_citation_aleatoire.sql
```

Puis vérifier que la table `citation` contient bien les citations.
