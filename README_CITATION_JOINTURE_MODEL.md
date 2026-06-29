# Citation aléatoire - Jointure dans le model MVC

Cette version n'utilise pas une table de jointure `user_humeur_citation`.

La relation se fait directement avec une colonne dans `user_humeur` :

```sql
user_humeur.id_citation -> citation.id
```

## Fonctionnement

1. L'utilisateur clique sur une humeur.
2. Il écrit sa note et valide.
3. Le model choisit une citation aléatoire de cette humeur avec `ORDER BY RAND() LIMIT 1`.
4. L'id de la citation est enregistré dans `user_humeur.id_citation`.
5. Sur la page d'accueil, le model fait une jointure :

```sql
LEFT JOIN citation c ON c.id = uh.id_citation
```

La citation ne change pas au refresh. Elle change seulement quand l'utilisateur choisit une nouvelle humeur.

## Fichiers importants

- `model/traitCitation.php`
- `model/traitUserHumeur.php`
- `controller/citationController.php`
- `vue/html/citationAccueil.php`
- `vue/css/citation.css`
- `correction_citation_mvc.sql`

## SQL à importer

Importer `correction_citation_mvc.sql` dans phpMyAdmin, base `sweetlife`.
