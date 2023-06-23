-- -----------------------------------------------------
-- Schema poli
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `poli` DEFAULT CHARACTER SET utf8 ;
USE `poli` ;

-- -----------------------------------------------------
-- Table `poli`.`categoria`
-- -----------------------------------------------------
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `img` varchar(45) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `poli`.`foto`
-- -----------------------------------------------------
CREATE TABLE `foto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alt` varchar(45) NOT NULL,
  `img` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `id_categoria` int NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_foto_UNIQUE` (`id`),
  KEY `fk_foto_categoria_idx` (`id_categoria`),
  CONSTRAINT `fk_foto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `poli`.`perfil`
-- -----------------------------------------------------

CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `poli`.`users`
-- -----------------------------------------------------

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil_id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ativo` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_perfil_idx` (`perfil_id`),
  CONSTRAINT `fk_users_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


