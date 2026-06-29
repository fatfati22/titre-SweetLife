# Correction — Modifier profil en MVC

La page `Modifier le profil` est maintenant séparée en MVC :

- `model/traitModifProfil.php` : récupération et modification de l'utilisateur.
- `controller/modifProfilController.php` : vérification session, validation formulaire, mise à jour et redirection.
- `vue/html/modifProfil.php` : affichage du formulaire.
- `vue/css/modifProfil.css` : layout propre + effet glass.

Route ajoutée dans `index.php` :

```php
case 'modifProfil':
    require_once __DIR__ . '/controller/modifProfilController.php';
    break;
```

Le formulaire permet de modifier :

- prénom ;
- nom ;
- email ;
- date de naissance ;
- mot de passe uniquement si les champs sont remplis.

Le bouton Annuler retourne vers `/index.php?route=profil`.
