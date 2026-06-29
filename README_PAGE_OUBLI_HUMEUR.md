# Page Oubli d'humeur

Cette correction ajoute une page MVC pour enregistrer une émotion oubliée.

## Fichiers ajoutés

- `controller/oubliController.php`
- `model/traitOubli.php`
- `vue/html/oubli.php`
- `vue/css/oubli.css`

## Route

```php
index.php?route=oubli
```

## Fonctionnement

L'utilisateur connecté peut choisir :

- une date ;
- une heure ;
- une humeur depuis la base SQL ;
- une note optionnelle.

La page ajoute ensuite une ligne dans `user_humeur` avec la date choisie.
Si une note est écrite, elle ajoute aussi une ligne dans `note` avec la même date.
Comme l'historique rapproche les notes et les humeurs par date, la note apparaît dans l'historique avec l'émotion oubliée.
