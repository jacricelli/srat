ALTER TABLE `registros`	ADD COLUMN `computable` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' AFTER `tipo`;