-- Correction pour que les notes s'enregistrent correctement
-- À lancer dans phpMyAdmin, onglet SQL, sur la base sweetlife

USE sweetlife;

ALTER TABLE note
MODIFY date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

-- Test manuel : si cette ligne apparaît dans phpMyAdmin, la table fonctionne
INSERT INTO note (description, date_creation, id_user)
VALUES ('Test note SQL', NOW(), 11);

SELECT * FROM note ORDER BY id DESC LIMIT 10;
