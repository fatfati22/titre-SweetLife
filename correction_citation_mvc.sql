-- =====================================================
-- correction_citation_mvc.sql
-- SweetLife - citation aléatoire gardée jusqu'au prochain changement d'humeur
-- Version sans table de jointure : jointure dans le model
-- user_humeur.id_citation -> citation.id
-- =====================================================

USE `sweetlife`;
SET NAMES utf8mb4;

ALTER TABLE `citation`
  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

ALTER TABLE `citation`
  MODIFY `texte` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  MODIFY `date_creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  MODIFY `id_humeur` INT NOT NULL;

SET @col_auteur_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'citation'
      AND COLUMN_NAME = 'auteur'
);

SET @sql = IF(
    @col_auteur_exists = 0,
    'ALTER TABLE `citation` ADD COLUMN `auteur` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT ''SweetLife'' AFTER `texte`',
    'SELECT "citation.auteur existe déjà" AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @col_id_citation_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_humeur'
      AND COLUMN_NAME = 'id_citation'
);

SET @sql = IF(
    @col_id_citation_exists = 0,
    'ALTER TABLE `user_humeur` ADD COLUMN `id_citation` INT NULL AFTER `id_humeur`',
    'SELECT "user_humeur.id_citation existe déjà" AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @idx_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'user_humeur'
      AND INDEX_NAME = 'user_humeur_id_citation_index'
);

SET @sql = IF(
    @idx_exists = 0,
    'ALTER TABLE `user_humeur` ADD KEY `user_humeur_id_citation_index` (`id_citation`)',
    'SELECT "index existe déjà" AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

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

SELECT
    uh.id,
    uh.id_user,
    h.nom AS humeur,
    c.texte AS citation,
    c.auteur,
    uh.date_enregistrement
FROM `user_humeur` uh
INNER JOIN `humeur` h ON h.id = uh.id_humeur
LEFT JOIN `citation` c ON c.id = uh.id_citation
ORDER BY uh.date_enregistrement DESC, uh.id DESC
LIMIT 20;
