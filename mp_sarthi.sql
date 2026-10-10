-- SQL dump to create `mp_sarthi` database with sample data

CREATE DATABASE IF NOT EXISTS `mp_sarthi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mp_sarthi`;

-- Users table (used by index.php and admin_view.php)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(150) DEFAULT NULL,
  `email` VARCHAR(150) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `mobile` VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bookings table (used by admin_view.php)
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED DEFAULT NULL,
  `destination` VARCHAR(255) DEFAULT NULL,
  `travel_date` DATE DEFAULT NULL,
  `travelers` INT DEFAULT NULL,
  `no_of_travelers` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_idx` (`user_id`),
  CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample user
INSERT INTO `users` (`fullname`, `email`, `password`, `mobile`) VALUES
('Demo User','demo@example.com','password123','9876543210');

-- Sample booking (references demo user)
INSERT INTO `bookings` (`user_id`, `destination`, `travel_date`, `travelers`, `no_of_travelers`) VALUES
(1, 'Khajuraho', '2026-12-15', 4, 4);
