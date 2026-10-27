-- 1. Criação do banco de dados
CREATE DATABASE IF NOT EXISTS biblioteca
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE biblioteca;

-- 2. Criação da tabela livro
CREATE TABLE IF NOT EXISTS livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    paginas INT NULL,
    genero VARCHAR(30) NOT NULL
);

-- 3. Inserção de livros de exemplo
INSERT INTO livro (titulo, autor, paginas, genero) VALUES
('Dom Casmurro', 'Machado de Assis', 256, 'Romance'),
('Duna', 'Frank Herbert', 680, 'Ficção Científica'),
('Steve Jobs', 'Walter Isaacson', NULL, 'Biografia'),
('Código Limpo', 'Robert C. Martin', 425, 'Técnico');

-- 4. Consulta dos registros
SELECT * FROM livro;
