-- =====================================================
-- correction_citation_aleatoire.sql
-- SweetLife : garder une citation aléatoire par humeur choisie
--
-- Objectif :
-- 1) Ajouter id_citation dans user_humeur
-- 2) Relier chaque humeur enregistrée à UNE citation
-- 3) La citation reste la même jusqu'au prochain changement d'humeur
-- =====================================================

USE `sweetlife`;
SET NAMES utf8mb4;

-- Ajouter la colonne id_citation si elle n'existe pas
SET @col_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_humeur'
      AND COLUMN_NAME = 'id_citation'
);

SET @sql = IF(
    @col_exists = 0,
    'ALTER TABLE `user_humeur` ADD COLUMN `id_citation` INT NULL AFTER `id_humeur`',
    'SELECT "La colonne id_citation existe déjà" AS info'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Ajouter un index sur id_citation si besoin
SET @idx_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_humeur'
      AND INDEX_NAME = 'id_citation'
);

SET @sql = IF(
    @idx_exists = 0,
    'ALTER TABLE `user_humeur` ADD KEY `id_citation` (`id_citation`)',
    'SELECT "L index id_citation existe déjà" AS info'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Ajouter la clé étrangère vers citation(id) si besoin
SET @fk_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_humeur'
      AND CONSTRAINT_NAME = 'user_humeur_ibfk_citation'
);

SET @sql = IF(
    @fk_exists = 0,
    'ALTER TABLE `user_humeur` ADD CONSTRAINT `user_humeur_ibfk_citation` FOREIGN KEY (`id_citation`) REFERENCES `citation` (`id`) ON DELETE SET NULL ON UPDATE CASCADE',
    'SELECT "La contrainte user_humeur_ibfk_citation existe déjà" AS info'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Donner une citation aux anciennes humeurs qui n'en ont pas encore.
-- On prend une citation disponible de la même humeur.
UPDATE `user_humeur` uh
SET uh.`id_citation` = (
    SELECT c.`id`
    FROM `citation` c
    WHERE c.`id_humeur` = uh.`id_humeur`
    ORDER BY RAND()
    LIMIT 1
)
WHERE uh.`id_citation` IS NULL
  AND EXISTS (
    SELECT 1
    FROM `citation` c2
    WHERE c2.`id_humeur` = uh.`id_humeur`
  );

-- Vérification
SELECT
    uh.id,
    u.prenom,
    h.nom AS humeur,
    c.texte AS citation,
    uh.date_enregistrement
FROM `user_humeur` uh
INNER JOIN `user` u ON u.id = uh.id_user
INNER JOIN `humeur` h ON h.id = uh.id_humeur
LEFT JOIN `citation` c ON c.id = uh.id_citation
ORDER BY uh.date_enregistrement DESC, uh.id DESC
LIMIT 20;
