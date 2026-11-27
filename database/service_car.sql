
-- ========================================
-- SERVICE CAR - BANCO DE DADOS
-- SGBD: MySQL
-- Ferramenta: MySQL Workbench
-- Engine: InnoDB
-- Character Set: utf8mb4
-- Collation: utf8mb4_unicode_ci
-- Conexão PHP: PDO
-- ========================================

CREATE DATABASE IF NOT EXISTS service_car
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

-- Selecionar o banco de dados
USE service_car;

-- Definir a engine padrão da sessão
SET SESSION default_storage_engine = InnoDB;

-- Configurar a codificação da conexão
SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;


USE service_car;

-- ========================================
-- TABELA: USUARIOS
-- ========================================

CREATE TABLE IF NOT EXISTS usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha_hash VARCHAR(255) NOT NULL,

    tipo ENUM(
        'cliente',
        'empresa',
        'admin'
    ) NOT NULL DEFAULT 'cliente',

    ativo BOOLEAN NOT NULL DEFAULT TRUE,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
