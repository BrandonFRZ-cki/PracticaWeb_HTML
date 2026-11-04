CREATE DATABASE IF NOT EXISTS contacto_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS contacto_web.mensajes (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre          VARCHAR(100)  NOT NULL,
  correo          VARCHAR(150)  NOT NULL,
  asunto          VARCHAR(150)  NOT NULL,
  mensaje         VARCHAR(2000) NOT NULL,
  fecha_registro  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
