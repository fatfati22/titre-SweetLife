-- Ajouter la colonne id_humeur à la table note
ALTER TABLE `note`
  ADD COLUMN `id_humeur` int NULL AFTER `id_user`;

-- Clé étrangère vers humeur
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id_humeur`) REFERENCES `humeur` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
