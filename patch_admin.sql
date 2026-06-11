-- ╔══════════════════════════════════════════════════════════╗
-- ║  PATCH SweetLife — Ajout module Admin                   ║
-- ║  À exécuter UNE seule fois sur la base existante         ║
-- ╚══════════════════════════════════════════════════════════╝

-- 1. Passer l'utilisateur admin en rôle 'admin'
--    (remplace l'id 4 par l'id réel de votre compte admin)
UPDATE `user` SET `role` = 'admin' WHERE `mail` = 'admin@gmail.com';

-- 2. Corriger la contrainte UNIQUE sur note.id_user
--    (un utilisateur doit pouvoir avoir PLUSIEURS notes)
ALTER TABLE `note` DROP INDEX `id_user`;

-- 3. S'assurer que la colonne role accepte la valeur 'admin'
--    (déjà varchar(50), rien à faire — juste mémo)

-- 4. Optionnel : données de test pour les tables vides
--    Humeurs par défaut (si la table est vide)
INSERT IGNORE INTO `humeur` (`id`, `nom`, `icone`, `couleur`) VALUES
(1, 'Calme',     '😌', 'theme-calme'),
(2, 'Joie',      '😄', 'theme-joie'),
(3, 'Tristesse', '😢', 'theme-tristesse'),
(4, 'Colère',    '😠', 'theme-colere'),
(5, 'Fatigue',   '😴', 'theme-fatigue'),
(6, 'Stress',    '😰', 'theme-stress');

-- Types de repas par défaut
INSERT IGNORE INTO `type_repas` (`id`, `nom`) VALUES
(1, 'Vegan'),
(2, 'Végétarien'),
(3, 'Sans gluten'),
(4, 'Omnivore');

-- Catégories par défaut
INSERT IGNORE INTO `categorie` (`id`, `nom`) VALUES
(1, 'Entrée'),
(2, 'Plat principal'),
(3, 'Dessert / Fruit'),
(4, 'Snack');
